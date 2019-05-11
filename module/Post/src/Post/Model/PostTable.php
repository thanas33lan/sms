<?php
namespace Post\Model;

use Zend\Session\Container;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\AbstractTableGateway;
use Post\Service\CommonService;
use Zend\Db\Sql\Expression;

class PostTable extends AbstractTableGateway {

    protected $table = 'posts';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function addPostDetailsAPI($params)
    {   
        $common = new CommonService;
        if(isset($params->Msg) && trim($params->Msg)!="")
        {
            $dbAdapter = $this->adapter;
            $sql = new Sql($dbAdapter);
            $query = $sql->select()->from('user_details')
            ->where(array('auth_token'=>$params->AuthToken));
            $queryStr = $sql->getSqlStringForSqlObject($query);
            $rResult=$dbAdapter->query($queryStr, $dbAdapter::QUERY_MODE_EXECUTE)->current();
            if(isset($rResult['user_id']) && trim($rResult['user_id']) != ""){
                $data = array(
                    'user_id' => $rResult['user_id'],
                    'message' => $params->Msg,
                    'time_on' => $common->getDateTime(),
                );
                $this->insert($data);
                $lastInsertedId = $this->lastInsertValue;
                $result = $this->select(array('post_id'=>$lastInsertedId))->current();
                if($lastInsertedId > 0){
                    $response['Status'] = 'success';
                    $response['PostDetails']=array(
                        'Message' => $result->message,
                    );
                }else{
                    $response['Status'] = 'failed';
                    $response['Message'] ='Not send try again';
                }
            }else{
                $response['Status'] = 'failed';
                $response['Message'] ="User don't have permission";
            }
        }else{
            $response['Status'] = 'failed';
            $response['Message'] ='Message not found';
        }
        return $response;
    }

    public function fetchPostDetailsByIdAPI($params) {
        $dbAdapter = $this->adapter;
        $sql = new Sql($dbAdapter);
        if(isset($params->AuthToken) && trim($params->AuthToken) != ""){
            $userQuery = $sql->select()->from(array('ud' => 'user_details'))->columns(array('UserId'=>'user_id'))
                            ->where(array('ud.auth_token' => $params->AuthToken));
            $userQueryStr = $sql->getSqlStringForSqlObject($userQuery);
            $userResult=$dbAdapter->query($userQueryStr, $dbAdapter::QUERY_MODE_EXECUTE)->current();
            
            if(isset($userResult->UserId) && $userResult->UserId !=''){
                $query = $sql->select()->from('posts')->columns(array('PostId'=>'post_id','UserId'=>'user_id','Msg'=>'message','TimeOn'=> new Expression("DATE_FORMAT(`time_on`, '%d-%M-%Y %r')")))
                ->order('time_on DESC');
                $queryStr = $sql->getSqlStringForSqlObject($query);
                // echo $queryStr;die;
                $rResult=$dbAdapter->query($queryStr, $dbAdapter::QUERY_MODE_EXECUTE)->toArray();
                
                $response['Status'] = 'success';
                $response['PostDetails'] = $rResult;
            }else{
                $response['Status']='fail';
                $response['Message']="Message not found";
            }
        }else {
            $response['Status']='fail';
            $response['Message']="Bad request please try again after some time";
        }
        return $response;
    }

}
