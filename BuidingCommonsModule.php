<?php
/**
 * Water Watcher Module
 *
 * @author Tibor Katelbach <oceatoon@mail.com>
 * @version 0.0.3
 *
*/

class TwhModule extends CWebModule
{
    
	const DBHOST = 'database.teeo.fr';
    const DBUSER = 'teeo';
    const DBPWD  = 'mo56be70';
    const DBNAME = 'teeo_bdd'; 
    const MAIN_BDD = 'teeo_bdd';
	const SEGA_BDD = 'teeo_sega';

    private $mysqli;


	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		Yii::app()->setComponents(array(
		    'errorHandler'=>array(
		        'errorAction'=>'/'.$this->id.'/error'
		    )
		));

		Yii::app()->mongodb->setDb('teeo');
		Yii::app()->homeUrl = "/ph/".$this->id;
		Yii::app()->theme  = "rapidos";
		$this->setImport(array(
			$this->id.'.models.*',
			$this->id.'.components.*',
		));
	}

	public function getMysqli()
	{
		$this->mysqli = new mysqli($this::DBHOST,$this::DBUSER,$this::DBPWD,$this::DBNAME);
	    return $this->mysqli;
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	private $_assetsUrl;

	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null)
	        $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
	            Yii::getPathOfAlias($this->id.'.assets') );
	    return $this->_assetsUrl;
	}

	
}
