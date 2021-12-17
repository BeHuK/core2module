<?php

use Mod\rbcity\Model\City;
use Mod\rbcity\Model\CityView;

require_once __DIR__ . "/Model/CityView.php";
require_once __DIR__ . "/Model/City.php";
require_once __DIR__ . "/../../core2/inc/classes/Panel.php";


class ModRbcityController extends Common
{

    public function action_index()
    {
        $app = "index.php?module=rbcity&action=index";
        $panel = new Panel();
        $view = new CityView();

        ob_start();

        try {
            if (isset($_GET['edit'])) {
                if (empty($_GET['edit'])) {
                    $panel->setTitle($this->_("Внесение записи"), '', $app);
                    echo $view->getEdit($app);

                } else {
                    $city = new City();
                    $panel->setTitle($city->getRbcityById($_GET['edit']) ? $city->getRbcityById($_GET['edit'])['name'] : '', $this->_('Редактирование записи'), $app);
                    echo $view->getEdit($app, $_GET['edit']);
                }
            } else {
                $panel->setTitle($this->_("Список городов РБ"));
                echo $view->getList($app);
            }

        } catch (Exception $e) {
            echo Alert::danger($e->getMessage(), 'Ошибка');
        }

        $panel->setContent(ob_get_clean());
        return $panel->render();
    }

}