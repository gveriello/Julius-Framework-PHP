<?php

class IndexPHP extends Page implements IEvent
{
    public function OnControllerLoaded()
    {
    }
    public function OnLayoutBinded()
    {
    }
    public function OnPreRender()
    {
    }
    public function OnLoad()
    {
    }
    public function CreateTable()
    {
    }
    public function QueryToDB()
    {
        $this->OrmHelper::getTable(Device, true);
    }
}