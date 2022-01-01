<?php
session_start();

class Components {
    
    public function addComponent($value) {
        $components = $this->readComponents();
        end($components); //get last item of an array
        
        if (!empty($components)) {
            $components[strval(key($components) + 1)] = $value;
        } else {
            $components[strval(0)] = $value;
        }
        
        $this->writeComponents($components);
    } 
    
    public function removeComponent($index) {
        $components = $this->readComponents();
        unset($components[strval($index)]);
        $this->writeComponents($components);
    }
    
    public function getComponents() {
        return $this->readComponents();
    }
    
    public function resetComponents() {
        $_SESSION['current_components'] = array();
    }
    
    private function readComponents() {
        return $_SESSION['current_components'] ?? array();
    }
    
    private function writeComponents($components) {
        $_SESSION['current_components'] = $components;
    }
}