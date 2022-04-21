<?php

class Tool {
    //Tool props
    public $id;
    public $categoryId;
    public $name;

    //constructor
    public function __construct(){
        //
    }

    public function read(){
        //dummy data
        $tool1 = array("id"=>1, "categoryId"=>2, "name"=>"Pencil", "image"=>"");
        $tool2 = array("id"=>2, "categoryId"=>2, "name"=>"Marker", "image"=>"");
        $tool3 = array("id"=>3, "categoryId"=>3, "name"=>"Blur", "image"=>"");

        $tools = array(
            $tool1,
            $tool2,
            $tool3
        );

        //filter data dummy way
        if ($this->id) {
            $tools = array_filter($tools, function ($t) {
                return $t["id"] == $this->id;
            });
        }
        if ($this->categoryId) {
            $tools = array_filter($tools, function ($t) {
                return $t["categoryId"] == $this->categoryId;
            });
        }
        if ($this->name) {
            $tools = array_filter($tools, function ($t) {
                return $t["name"] == $this->name;
            });
        }

        return $tools;
    }
}

?>