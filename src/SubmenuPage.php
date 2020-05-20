<?php

namespace EventCalendar;

class SubmenuPage {
 
 /**
* This function renders the contents of the page associated with the Submenu
* that invokes the render method. In the context of this plugin, this is the
* Submenu class.
*/
    public function renderConfig() {

        echo _e('This is the basic submenu page.', '');
    }

    public function Edit(){
        echo "Edit";
    }
}