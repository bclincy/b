<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/7/18
 * Time: 10:14 AM
 */

namespace App\Middleware;


use App\Authorization\Encryptor;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class Csfr
{
    /** @var string  */
    private $key = 'access_token';

    private $token;

    /** @var array $error */
    private $error;

    /** @var Encryptor $encryption */
    private $encryption;

    /** @var  ContainerInterface */
    private $container;

    /** @var array Post */
    private $req;


    /**
     * Csfr constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->encryption = new Encryptor();
    }


    public function __invoke(ServerRequestInterface $req, Response $res, callable $next)
    {
        $this->req = $req->getParsedBody();
        $this->secCheck();
        $this->container->view->getEnvironment()
            ->addGlobal('token', $this->formComponents($this->generateToken()));
        $res = $next($req, $res);

        return $res;
    }

    /**
     * AddFlashError if errors exists add to Flash Message Services
     * @return bool
     */
    private function addFlashError ()
    {
        //Clear the messages first

        if (is_array($this->error)) {
            foreach($this->error as $error => $msg) {
                $this->container->flash->addMessage($error, $msg);
            }

            return true;
        } else {
            $this->container->flash->clearMessages();
        }

        return false;
    }

    /**
     * Add Form Component for validation
     * @param string $token
     * @return string
     */
    private function formComponents (string $token)
    {
        return '<input type="hidden" name="'. $this->key .'" value="'. $token.'" />';
    }

    /**
     * Generated an encrypted string
     * @return string
     */
    private function generateToken ()
    {
        $data = json_encode([
            'IP'        => $_SERVER['REMOTE_ADDR'],
            'url'       => $_SERVER["SCRIPT_URL"],
            'usrAgent'  => $_SERVER["HTTP_USER_AGENT"]]
        );

        $token = $this->encryption->deepEncrypt($data,$_ENV["APP_SECRET"]);

        return $token;
    }


    private function secCheck ()
    {
        //Todo: Add the secCheck to validate all of the must haves
        //Posted in the body ajax request or direct Post
        if ( isset($_POST["g-recaptcha-response"]) || isset($this->req["g-recaptcha-response"])) {
            $secCheck[] = $this->verifyGoogle();
        }
        if (isset($_POST[$this->key]) || isset($this->req[$this->key])) {
//            $secCheck[] = $this->verifyToken($_POST['g-recaptcha-response']);
        }

        $this->addFlashError();

    }

    /**
     * Verify Google's recaptcha
     * @return bool
     */
    public function verifyGoogle ()
    {
        $response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : $this->req["g-recaptcha-response"];

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $_ENV['RECAPTCHA_SEC'],
            'response' => $response
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);

        if ($captcha_success->success !== true) {
            $this->error['captcha'] = 'Please Confirm you\'re more human than a BOT completing the ReCaptcha';
        }

        return $captcha_success->success;
    }

    /**
     * verify the site issued token
     * @param $token string
     * @return bool
     */
    private function verifyToken ($token)
    {
        if($this->encryption->undeepEncrypt($token, $_ENV['APP_SECRET'] !== true)) {
            $this->error['badToken'] = 'False Negatives, something went wrong please try again';
            //To investigate save token so you can get the current userdata
            $this->container->logger->warning('Token was bad token' . $token . ' check current data' . $this->generateToken());
        } else {
            // not saving the successful tokens in the database so saving it in the log file
            $this->container->logger->info('Token Verified: '. $token);
        }

        return isset($this->error['badToken']);
    }

}