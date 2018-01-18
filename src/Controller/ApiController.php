<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 11/17/17
 * Time: 6:22 AM
 */

namespace app\Controller;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ApiController
{


    /**
     * @var ContainerInterface
     */
    protected $container;
    /** @var mixed|\PDO */
    protected $pdo;
    /** @var array $error */
    protected $error;
    /** @var \Monolog\Logger */
    protected $logger;
    /** @var array $apiMsgs */
    protected $apiMsgs;
    /** @var array $required */
    protected $required = [
        'mothersday' => ['fname|string|2', 'lname|string|2', 'email|string'],
        'contact' => ['name|string|5', 'emailCnt|email|', 'message|string|5', 'status|int|3']
    ];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdo = $this->container->pdo;
        $this->logger = $this->container->logger;
        $this->apiMsgs = $this->container->apiStatus['code'];
    }


    public function contactFrm (Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        if ($data !== null) {
            array_walk($this->required['contact'], [$this, 'meetsRequirements'], $data);
            if ($this->error !== null) {
                $data = $this->apiMsgs[400];
                $data['status'] = 'Error';
            } else {
                list($fname, $lname)  = explode(' ', $request->getAttribute('name'));
                $sql = 'INSERT INTO ';
                $data['status'] = 200;
                $data['msg'] = 'Success';
            }
        } else {
            $data = $this->restErrors(500);
            $data['status'] = 'error';
        }

        return $response->withJson($data)->withHeader('Content-Type', 'application/json');
    }

    public function contact (Request $request, Response $response)
    {
        if( $data = $request->getParsedBody() ) {
            if (isset($error) && is_array($error)) {
                $msg['details'] = implode("\n", $error);
                $msg['code'] = 400;
                $data = $this->restErrors($msg);
            } else {
                $data = [];
                $data['code'] = 200;
                $data['success'] = true;
                $data['status'] = "We sent an email";
            }
        }
        if ($data == null) {
            $data = $this->restErrors($msg['code'] = 500);
        }
        return $response->withJson($data)->withHeader('Content-Type', 'application/json');

    }

    public function test()
    {
        echo 'noal';
        die('hello');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function newsSignup(Request $request, Response $response)
    {
        $body = $request->getBody();
        $data = ['fname'=>'Brian', 'lname'=>'clincy'];

        return $response->withJson($data)->withHeader('Content-Type', 'application/json');
    }

    public function restErrors($msg)
    {
        switch ($msg['code']) {
            case 400:
                $data = ['msg' => 'Bad Request, check data', 'code' => 400];
                break;
            case 401:
                $data = ['msg' => 'Unauthorized please check your credentials', 'code' => 401];
                break;
            case 404:
                $data = ['msg' => 'The Resources requested does not exists', 'code' => 404];
                break;
            case 402:
                $data = ['msg' => 'Parameters were valid but the request failed', 'code' => 402];
                break;
            case 429:
                $data = ['msg' => 'Too many request hit the API in concession', 'code' => 429];
                break;
            case 500:
                $data = ['msg' => 'Internal Server error our side is down', 'code' => 500];
                break;
            default:
                $data['msg'] = 'System is currently down please try again later';
        }

        $data['error'] = $msg['error'];
        $data['status'] = 'Failed';
        $data['details'] = $this->error;
        return array_filter($data);

    }

    public function genericForm (Response $response, Request $request)
    {
        $name = $request->getAttribute('frmName');

    }

    public function nnutsById(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');
            $stmt = $this->pdo->prepare('SELECT * FROM podcast WHERE id = :id');
            $stmt->execute([':id' => $id]);
            $data = $stmt->fetchAll();
            $data = $data[0] !== null ? $data[0] : [];
        } catch (\Exception $e) {
            $this->logger->addError('NNUTS by ID' . print_r($request, true));
            $data = $this->restErrors(400);
        }
        return $response->withJson($data)->withHeader('Content-Type', 'application/json');

    }

    private function validate()
    {
        $form = $this->form['name'];
        if ($this->required[$form] !== null ) {

        } else {
            $return = false;
        }


    }


    private function meetsRequirements ($details, $key, $data)
    {
        list($name, $type, $length) = explode('|', $details);
        if ($data[$name] === null) {
            $error[$data->verify][] = $name . ' Was Empty';
        }
        switch ($type) {
            case 'int':
                if ( $data[$name] < $length ) {
                    $error[$name][] = ucwords($name) . ' number smaller than min';
                }
                break;
            case 'string':
                if (strlen($data[$name]) < $length) {
                    $error[$name][] = $key .' is string smaller than min';
                }
                break;
            case 'date':
                if (!$this->validateDate($data[$name], $length)) {
                    $error[$name][] = $key . ' is not a date';
                } else {
                    $this->logger->adderror('ContactFrm API error ' . print_r($data, true));
                }
                break;
        }
        if (is_array($error)) {
            $this->error[$data->verify] = $error;
            return false;
        }

        return true;
    }

    public function isValidToken()
    {
        $token = $_SERVER['PHP_AUTH_USER'];
        if ($token === null) {
            $valid = false;
        } else {
            $user = base64_decode($_SERVER['PHP_AUTH_USER']);
            $valid = true;
        }

        return $valid;
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}