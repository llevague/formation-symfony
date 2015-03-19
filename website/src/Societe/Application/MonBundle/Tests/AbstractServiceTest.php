<?php
/**
 * Created by PhpStorm.
 * User: nguilmeau
 * Date: 07/08/14
 * Time: 09:45
 */
namespace Societe\Application\MonBundle\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class AbstractServiceTest
 * Classe d'initialisation du contexte de tests
 *
 * @package ICert\Matrix\RestAPIBundle\Tests
 */
abstract class AbstractServiceTest extends WebTestCase
{

    /**
     * @var KernelInterface
     */
    protected static $kernel;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Application
     */
    protected $application;

    /**
     * Intialisation de données et container
     */
    public function setUp()
    {
        ini_set('memory_limit', '512M');
        set_error_handler('var_dump', E_ERROR);


        date_default_timezone_set('Europe/Paris');

        self::$kernel = $this->createKernel(array('environment' => 'test'));
        self::$kernel->boot();

        $this->application = new Application(self::$kernel);
        $this->application->setAutoExit(false);

        //Create de Schema
        try {
            $this->runConsole("cache:clear", array("--env" => 'test'));
            $this->runConsole("doctrine:schema:drop", array("--force" => true));
            $this->runConsole("doctrine:schema:create");
//            $this->runConsole("doctrine:fixtures:load", array("--fixtures" => __DIR__ . "/DataFixtures"));
            $this->runConsole("doctrine:fixtures:load", array("--fixtures" => "/var/www/formation/website/src/Societe/Application/MonBundle/Tests/DataFixtures"));
        } catch (\Exception $e) {
            error_log($e);
            throw $e;
        }

        // Container
        $this->container = self::$kernel->getContainer();
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

    /**
     * Exécution de commandes symfony / doctrine
     *
     * @param string $command
     * @param array $options
     *
     * @return mixed
     */
    protected function runConsole($command, Array $options = array())
    {
        $options["-e"] = "test";
        $options["-q"] = null;
        $options = array_merge($options, array('command' => $command));

        $output = new BufferedOutput();
        $output->setVerbosity(OutputInterface::VERBOSITY_DEBUG);

        $retour = $this->application->run(new ArrayInput($options), $output);

        return $retour;


    }


    /**
     * Controle de réception d'une réponse JSON
     *
     * @param Response $response
     * @param int $statusCode
     */
    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode,
            $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }


    /**
     * Test de récupération d'une Exception.
     *
     * @param callable $callback
     * @param string $expectedException
     * @param null $expectedCode
     * @param null $expectedMessage
     *
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function assertException(callable $callback, $expectedException = 'Exception', $expectedCode = null, $expectedMessage = null)
    {
        if (!class_exists($expectedException) || interface_exists($expectedException)) {
            $this->fail("An exception of type '$expectedException' does not exist.");
        }

        try {
            $callback();
        } catch (\Exception $e) {
            $class = get_class($e);
            $message = $e->getMessage();
            $code = $e->getCode();

            $extraInfo = $message ? " (message was $message, code was $code)" : ($code ? " (code was $code)" : '');
            $this->assertInstanceOf($expectedException, $e, "Failed asserting the class of exception$extraInfo.");

            if (null !== $expectedCode) {
                $this->assertEquals($expectedCode, $code, "Failed asserting code of thrown $class.");
            }
            if (null !== $expectedMessage) {
                $this->assertContains($expectedMessage, $message, "Failed asserting the message of thrown $class.");
            }
            return;
        }

        $extraInfo = $expectedException !== 'Exception' ? " of type $expectedException" : '';
        $this->fail("Failed asserting that exception$extraInfo was thrown.");
    }
} 