<?php

namespace EventCalendar;

class SubmenuPage {
 
 /**
* This function renders the contents of the page associated with the Submenu
* that invokes the render method. In the context of this plugin, this is the
* Submenu class.
*/
    public function renderConfig() {

        echo _e('<h2>This is basic submenu page.</h2>', '');
    }

    public function Edit(){

        echo "<h2>Second Menu</h2>";
       
    }

    function admin_init()
    {
        echo "<h2>First Menu</h2>";
    }

}
