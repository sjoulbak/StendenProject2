<?php
/**
 * Created by PhpStorm.
 * User: Alwin
 * Date: 20-11-2015
 * Time: 10:26
 */

class Tickets {



    private $db;
    private $core;


    public function __construct(Core $core, Database $db){
        $this->db = $db;
        $this->core = $core;
    }

    public function view($id){

        $result = $this->db->doquery("SELECT * FROM {{table}} WHERE id='$id'","tickets");
        $row = mysqli_fetch_array($result);

        echo '
      <div id="content_center">
        <md-content id="content_center_top" layout="row" class="md-whiteframe-1dp layout-row">
          <div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">
            <md-button href="mailto:'.$row["email"].'"><span class="glyphicon glyphicon-pencil"></span></md-button>
            <md-button><span class="glyphicon glyphicon-flag glyphicon "></span></md-button>
            <form id="delete" action="index.php?id='.$row['id'].'" method="post">
              <md-button> <span style="position:relative; left:38.5%;" class="glyphicon glyphicon-trash"></span> <input type="submit" name="delete" class="right_setting" id="remove_ticket" value=" "></md-button>
            </form>
          </div>
          <div layout="row" layout-align="end center" flex class="flex layout layout-row layout-align-end-center">
              <md-menu md-position-mode="target-right target">
                Ticket: '.$row["id"].'
              </md-menu>
          </div>
        </md-content>

        <md-content style="border-bottom: 1px solid #D9DCDF;" id="content_center_subject" layout="row" class="md-whiteframe-1dp layout-row">
          <div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">
            <div class="inbox_subject" class="md-whiteframe-1dp layout-row">
                <h3 style="font-weight:400;">'.$row["subject"].'</h3>
                <span>'.$row["published"].'</span><br>
                <span style="position:relative; top:2px;" >Van: <a href="mailto:'.$row["email"].'" style="color:#0cc2aa;">'.$row["email"].'</a></span>
            </div>
          </div>
        </md-content>
        <md-content id="inbox" class="md-whiteframe-1dp">
            <div class="mails" layout="row">
              <div style="padding:20px;" id="container">
                  <p>
                    Hallo,<br>

                    Na aanleiding van de aankoop van gisteren doe ik u hierbij deze brief.<br>


                    mvg,<br>

                    Tom Drent



                  </p>


              </div>
          </div>
	    </md-content>
      </div>
        ';
    }

}