<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 11/17/17
 * Time: 6:22 AM
 */

namespace App\Controller;


use App\Models\Joblead;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Repository\Shoutouts as Shout;
use Respect\Validation\Validator as v;

class ApiController extends Controller
{


    /**
     * @var ContainerInterface
     */

    /** @var array $required */
    protected $required = [
        'mothersday' => ['fname|string|2', 'lname|string|2', 'email|string'],
        'contact' => ['name|string|5', 'emailCnt|email|', 'message|string|5'],
        'shoutout' => ['name|string|5', 'shoutout|string|15', 'slugs|string|3'],
    ];


    public function addShoutout(Request $request, Response $response)
    {
        $shoutout = $request->getParsedBody();
        if ($shoutout !== null) {
            array_walk($this->required['shoutout'], [$this, 'meetsRequirements'], $shoutout);
            if (!isset($this->error)) {
                //build the array;
                $update = $this->shoutoutDataSet($shoutout);
                $upShoutOut =new Shout($this->pdo);

                $id = $upShoutOut->add($update);
                $data = $id > 0 ? [
                                'status' => 'success',
                                'code' => 200,
                                'id'=> $id,
                                'msg' => 'Create a Shoutout id '.$id
                                ] :
                    ['status' => 'Failed', 'code' => 200, 'msg' => 'Did not create update'];
            } else {
              $data = $this->restErrors(['code'=>400]);
            }
        } else {
            $msg = ['code'=>400, 'error'=>'No data'];
            $data = $this->restErrors($msg);
        }

        return $response->withJson($data)->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept-Language', 'en-US')
            ->withHeader('Authorization', 'Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');

    }

    public function contactFrm (Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        if ($data !== null) {
            array_walk($this->required['contact'], [$this, 'meetsRequirements'], $data);
            $data['email'] = $data['emailCnt'];
            if ($this->error !== null) {
                $return = $this->apiMsgs['codes'][400];
                $return['status'] = 'Failure';
                $error = ucwords(implode(' <br />', $this->error[0]));
                $return['content'] = '<h2>Please Fill All Required Fields</h2><p>' . $error . '</p>';
            } else {
                list($firstName, $lastName) = $this->nameSplits($data['name']);
                try {
                    $name = $data['name'];
                    $dbdata = [
                        ':fname' => $firstName,
                        ':lname' => $lastName,
                        ':email' => $data['emailCnt'],
                        ':subject' => $data['subject'],
                        ':message' => $data['message'],
                    ];
                    $sql = 'INSERT INTO contact (fname, lname, email, subject, message, isReturned, recievedOn) VALUES (
                             :fname, :lname, :email, :subject, :message, 0, now() )';
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute($dbdata);
                    $return['id'] = $this->pdo->lastInsertId();
                    $mail = $this->sendmail($data);
                    $return['sent'] = $mail;
                    $return['status'] = 200;
                    $return['msg'] = 'Success';
                    $return['content'] = '<div><h1><i class="fa fa-thumbs-o-up fa-2x"'
                        . 'aria-hidden="true"></i> ' . $name . ' your message was sent!</h1>' . '<p>Thank you your ' .
                        'feedback is important to us please give us 24 hours to respond to your message.</p>';
                } catch (\Exception $e) {
                    $return = $this->restErrors(500);
                    $return['content'] = $e->getMessage();
                    return $response->withJson($return)->withHeader('Content-Type', 'application/json');
                }
            }
        } else {
            $return = $this->restErrors(500);
            $return['status'] = 'error';
        }

        return $response->withJson($return)->withHeader('Content-Type', 'application/json');
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

    public function resume (Request $req, Response $resp)
    {
        $data = $req->getParsedBody();
        $data['name'] = ucwords($data['name']);
        $required = [
            'name' => v::length(3)->notEmpty(),
            'email'=> v::notEmpty()->noWhitespace()->email(),
            'developer' => v::notEmpty()->noWhitespace()->length(3)
        ];
        $gvalid = $this->container->flash->getMessages();
        $validate = $this->validator->validate($req, $required);
        if (!$validate->failed() && !isset($gvalid['captcha'][0])) {
            $newLead = Joblead::create([
                'name' => $data['name'],
                'linkedIn' => $data['linkedin'],
                'agency'=> $data['agency'],
                'DevType'=> strtoupper($data['developer']),
                'note' => $data['message'],
                'email' => $data['email']
            ]);
            $_SESSION['viewResume'] = [$data, time()];
            $msg = sprintf('%s thank you!', $data['name']);
            $return = $this->restSuccessful($msg, $newLead->id);
        } else {
            $msg['status'] = 402;
            $return = $this->restErrors($msg);
            $return['form'] = $validate->getErrors();
            $return['form']['captcha'] = $gvalid['captcha'][0];
        }
        $data['ts'] = time();
        $return['key'] = base64_encode(json_encode([$data['name'], $data['email']]));
        $return['repost'] = $data;

        return $resp->withJson($return, 201);
    }

    public function newsSignup(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();
        $data = ['fname'=>'Brian', 'lname'=>'clincy'];

        return $response->withJson($data)->withHeader('Content-Type', 'application/json');
    }

    public function restErrors($msg)
    {
        $data['code'] = $msg['status'];
        switch ($msg['status']) {
            case 400:
                $data = ['msg' => 'Bad Request, check data'];
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

    public function restSuccessful($msg, $id = null)
    {
        $data = [ 'status' => 'Success',
                'code' => 200,
                'details' => $msg,
                'id' => $id !== null ? $id : null
                ];

        return $data;
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

    private function meetsRequirements ($details, $key, $data)
    {
        list($name, $type, $length) = explode('|', $details);
        if (isset($name) && !isset($data[$name])) {
            $error[] = ucwords(strtolower($name)) . ' Was Empty';
        } else {

            switch ($type) {
                case 'int':
                    if ( $data[$name] < $length ) {
                        $error[] = ucwords($name) . ' number smaller than min';
                    }
                    break;
                case 'string':
                    if (strlen($data[$name]) < $length) {
                        $error[] = $key .' is string smaller than min';
                    }
                    break;
                case 'email':
                    if (!filter_var($data[$name], FILTER_VALIDATE_EMAIL)) {
                        $error[] = $data[$name] . ' has an invalid email format';
                    }
                    break;
                case 'date':
                    if (!$this->validateDate($data[$name], $length)) {
                        $error[] = $key . ' is not a date';
                    }
                    break;
            }
        }
        if (isset($error) && is_array($error)) {
            $dd = print_r($_SERVER, true) . "\n" . print_r($data, true);
            $this->logger->addInfo('Bad contact form data dump: '.$dd );
            $this->error[] = $error;
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
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    private function nameSplits ($name)
    {
        $name = ucwords(strtolower($name));
        list($firstName, $lastName)  = explode(' ', $name);
        if ($firstName === null || $lastName === null) {
            $firstName = ucwords(strtolower($name));
            $lastName = $firstName;
        }

        return [$firstName, $lastName];

    }


    private function shoutoutDataSet(array $shoutout)
    {
        $shoutout['website'] = !isset($shoutout['website'])  ? null : $shoutout['website'];
        // Format Slugs
        if (isset($shoutout['slugs'])) {
            $isJson = json_decode($shoutout['slugs'], true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                if (substr_count($shoutout['slugs'], ',') > 0) {
                    $slugs = json_encode(explode(',', $shoutout['slugs']));
                } else {
                    $slugs = json_encode($shoutout['slugs']);
                }
            } else {
                $slugs = $shoutout['slugs'];
            }
            $shoutout['slugs'] = $slugs;
        } else {
            $shoutout['slug'] = null;
        }

        if (isset($shoutout['location'])){
            $locationData = new LocationDetails();
            $data = $locationData->getLocation('Muskegon, MI');
            print_r($data);
        } else {
            $shoutout['location'] = null;
        }
        $db = [];
        //add the key for databinding
        array_walk($shoutout,function ($a, $b) use (&$db){ $db[':'.$b] = $a; });

        return $db;
    }

}