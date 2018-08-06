<?php

class FormCreator{

    private $framework = "Bootstrap";
    private $class = array("Bootstrap" => "form-control");
    private $form = "";
    private $label = "";
    private $required = "";
    private $container = "<div class='col'>{form}</div>";

    public function required(){
        $this->required = "required='required'";
        return $this;
    }

    public function container($class){
        $container = "<div class='{class}'>{form}</div>";
        $this->container = str_replace("{class}", $class, $container);
        return $this;
    }

    public function label($name, $for, $size, $class=""){
        $lab = "<label ";
        $lab .= 'for="' . $for . '" ';
        $lab .= 'class="' . $size . ' control-label col-form-label ' . $class . '" ';
        $lab .= '>' . $name . '</label>';
        $this->label = $lab;
        return $this;
    }

    public function input($type, $name, $id, $placeholder = "isi", $value = "", $class = ""){
        $ret = "<input ";
        $ret .= 'type="' . $type . '" ';
        $ret .= 'class="' . $this->class[$this->framework] . ' ' . $class . '" ';
        $ret .= 'name="' . $name . '" ';
        $ret .= 'id="' . $id . '" ';
        $ret .= 'placeholder="' . $placeholder . '" ';
        $ret .= 'value="' . $value . '" ';
        $ret .= '{required}';
        $this->form .= $ret . ">";
        return $this;
    }

    public function textarea($name, $id, $placeholder = "isi", $value = ""){
        $ret = "<";
        $ret .= 'textarea style="resize: none;" ';
        $ret .= 'class="' . $this->class[$this->framework] . '" ';
        $ret .= 'name="' . $name . '" ';
        $ret .= 'id="' . $id . '" ';
        $ret .= 'placeholder="' . $placeholder . '" ';
        $ret .= '{required}';
        $ret .= '>' . $value . '</textarea>';
        $this->form = $ret; 
        return $this;
    }

    public function select($name, $id, $element, $value = "", $class="", $attr = ""){
        $return = "<select id='" . $id . "' class='" . $this->class[$this->framework] . " " . $class . "' name='" . $name . "' {required} ". $attr . ">";
        $return .= "<option value=''>Pilih</option>";
        foreach($element as $e){
            if(is_object($e)){
                $selected = ($value == $e->value) ? "selected='selected'" : "";
                $return .= "<option " . $selected . " value='" . $e->value . "'>" . $e->display . "</option>";
            } else if(is_array($e)){
                $selected = ($value == $e['value']) ? "selected='selected'" : "";
                $return .= "<option " . $selected . " value='" . $e['value'] . "'>" . $e['display'] . "</option>";
            } else {
                $selected = ($value == $e) ? "selected='selected'" : "";
                $return .= "<option " . $selected . " value='" . $e . "'>" . $e . "</option>";
            }
        }
        $return .= "</select>";
        $this->form = $return;
        return $this;
    }

    public function show(){
        if(preg_match("/\{class\}/", $this->container)){
            $this->container = str_replace("{class}", "col-sm-9", $this->container);
        }
        $print = $this->label . str_replace("{form}", $this->form, $this->container);
        $print = str_replace("{required}", $this->required, $print);
        $this->label = "";
        $this->form = "";
        $this->required = "";
        $this->container = "<div class='col'>{form}</div>";
        return $print;
    }

}