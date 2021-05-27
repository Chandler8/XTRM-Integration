<?php
    /**
     * Name: Chandler Lowrance
     * Date: 5/27/21
     * Working with adding functionality to the "Submit" button with XTRM.
     */

    if ($_GET) {
        if (isset($_GET['insert'])) {
            insert();
        } elseif (isset($_GET['select'])) {
            select();
        }
    }

    function select()
    {
       echo "The select function is called.";
    }

    function insert()
    {
       echo "The insert function is called.";
    }
?>