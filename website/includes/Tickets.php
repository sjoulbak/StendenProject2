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
    private $user;


    public function __construct(Core $core, Database $db, $user){
        $this->db = $db;
        $this->core = $core;
        $this->user = $user;
    }

    public function view($id){

        $result = $this->db->doquery("SELECT * FROM {{table}} WHERE id='$id'","tickets");
        $row = mysqli_fetch_array($result);

        echo '
      <div id="content_center">
        <md-content id="content_center_top" layout="row" class="md-whiteframe-1dp layout-row">
          <div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">
            <md-button href="mailto:'.$row["email"].'"><span class="glyphicon glyphicon-pencil"></span></md-button>
            <md-button><span class="glyphicon glyphicon-flag"></span></md-button>
            <md-button onclick="window.open(\'?delete='.$id.'\',\'_top\')"><span class="glyphicon glyphicon-trash"></span></md-button>
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
                    '.$row['message'].'
                  </p>
              </div>
          </div>
	    </md-content>
      </div>
        ';

    }

    public function getAll(){

        echo '

    <div id="content_center">
      <md-content id="content_center_top" layout="row" class="md-whiteframe-1dp layout-row">
          <div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">

              <span id="content_center_top_setting" class="glyphicon glyphicon-cog"></span>

          </div>
          <div layout="row" layout-align="end center" flex class="flex layout layout-row layout-align-end-center">
              <md-menu md-position-mode="target-right target">
                asd
              </md-menu>
          </div>
      </md-content>

      <md-content style="border-bottom: 1px solid #D9DCDF;" id="content_center_subject" layout="row" class="md-whiteframe-1dp layout-row">
          <div layout="row" layout-align="center center" class="layout layout-row layout-align-center-center">
            <div class="inbox_subject" class="md-whiteframe-1dp layout-row">
                <div class="mails" id="inbox_subject2" layout="row">
                  <div id="container">
                      <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1">
                      </md-checkbox>
                      <span id="envelope2" class="glyphicon glyphicon-envelope envelope_transparent"></span>
                      <div id="id">Ticket</div>
                      <div id="subject">Subject</div>
                      <div id="department">Department</div>
                      <div id="priority">Priority</div>
                      <div id="email">Email</div>
                      <div id="status">Status</div>
                      <div id="published">Published</div>
                      <span id="mark2" class="glyphicon glyphicon-flag"></span>
                  </div>
              </div>
            </div>
          </div>
      </md-content>
    <md-content id="inbox" class="md-whiteframe-1dp">
            ';



        $result = $this->db->doquery("SELECT * FROM {{table}} WHERE user='".$this->user['id']."' LIMIT 0,20","tickets");


        while($row = mysqli_fetch_array($result)){
            echo '
          <a href="?view=' . $row['id'] . '">
            <div class="mails" layout="row">
              <div id="container">
                  <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1" class="checkBox"></md-checkbox>
                  <span id="envelope" class="glyphicon glyphicon-envelope"></span>
                  <div id="id">'.$row["id"].'</div>
                  <div id="subject">'.$row["subject"].'</div>
                  <div id="department">'.$row["department"].'</div>
                  <div id="priority">'.$row["priority"].'</div>
                  <div id="email">'.$row["email"].'</div>
                  <div id="status">'.$row["status"].'</div>
                  <div id="published">'.$row["published"].'</div>
                  <md-button  class="md-icon-button" aria-label="More" ng-click="$mdOpenMenu($event)">
                    <span id="mark" class="glyphicon glyphicon-flag"></span>
                  </md-button>
              </div>
            </div>
          </a>
          ';
        }
        echo '

	</md-content>

	';
    }
    public function delete($id){

        $r = $this->db->doquery("SELECT id FROM {{table}} WHERE id='$id'","tickets");
        if(mysqli_num_rows($r) > 0){
            $this->db->doquery("DELETE FROM {{table}} WHERE id='$id' ","tickets");
        }
    }
    public function newTicket(){
        echo '

            <section id="container">
            <section id="formblock">
                <h1 id="stelvraag">Stel uw vraag!</h1>
                <p>Door het formulier hieronder in te vullen kunt u uw vraag of klacht bij ons neerleggen.
                    U krijgt meestal binnen 24 uur antwoord, het kan maximaal 5 dagen duren.
                  <form method="post" id="contactForm" action="" name="incidentForm">
          ';

            if(isset($_POST['newTicket'])){
                $subject = $this->db->esc_str($_POST['subject']);
                $mail = $this->db->esc_str($_POST['email']);
                $priority = $this->db->esc_str($_POST['priority']);
                $department = $this->db->esc_str($_POST['department']);
                $description = $this->db->esc_str($_POST['description']);

                $errors = 0;
                if(strlen($subject) < 2){
                    echo "Geen onderwerp ingevult.<br />";
                    $errors++;
                }
                if($this->core->isEmail($mail) != null){
                    echo $this->core->isEmail($mail);
                    $errors++;
                }
                if(strlen($description) < 2){
                    echo "Geen toelichting ingevult.<br />";
                    $errors++;
                }
                if(strlen($department) < 2){
                    echo "Geen afdeling ingevult.<br />";
                    $errors++;
                }
                if($errors == 0){
                    $id = $this->db->do_insert_query("INSERT INTO {{table}} SET subject='$subject', message='$description', department='$department', priority='$priority', email='$mail', status='1', published=NOW(), user='".$this->user['id']."'", "tickets");

                    echo '<script type="text/javascript">
                               window.location = "index.php?view='.$id.'&flash=Ticket%20toegevoegd.";
                          </script>';

                }

            }
        echo '
                    <div class="form">
                        <label>Onderwerp</label>
                        <input type="text" placeholder="Onderwerp" name="subject" />
                    </div>
                    <div class="form">
                        <label>Email Adres</label>
                        <input type="email" placeholder="Email Adres" name="email" />
                    </div>
                    <div class="form">
                        <select id="selectmenu" name="priority">
                            <option value="" disabled selected>Prioriteit</option>
                            <option value="3">High</option>
                            <option value="2">Medium</option>
                            <option value="1">Low</option>
                        </select>
                    </div>
                    <div class="form">
                        <label for="department">Department</label>
                        <input type="text" placeholder="Afdeling" name="department" />
                    </div>
                    <div class="form">
                        <label>Toelichting</label>
                        <textarea rows="5" placeholder="Toelichting" name="description"></textarea>
                    </div>
                    <br />
                    <input id="contactbutton" type="submit" value="Verstuur" name="newTicket"/>
            </form>
            </section>
            <section id="QA">
                <h1 id="stelvraag">Veelgestelde vragen</h1>
                <p>Voor u uw vraag stelt kunt u ook kijken of uw vraag hier tussenstaat.
                    Zo voorkom je dat je moet wachten op je vraag!
              <ul>
                <li class="question">Wanneer kan ik antwoord verwachten?<i class="fa fa-angle-down"></i></li>
                <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                         Maecenas a mattis augue.
                        Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Wat houdt de prioriteit in en wat vul ik daar in?<i class="fa fa-angle-down"></i></li>
                  <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                             Maecenas a mattis augue.
                            Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Hoe weet ik naar welke afdeling mijn probleem moet?<i class="fa fa-angle-down"></i></li>
                  <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                                 Maecenas a mattis augue.
                                Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Ik kan niet inloggen wat kan ik nu doen?<i class="fa fa-angle-down"></i></li>
                    <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                             Maecenas a mattis augue.
                            Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Hoe kan ik me afmelden voor de helpservice?<i class="fa fa-angle-down"></i></li>
                    <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                             Maecenas a mattis augue.
                                Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
              </ul>
            </section>
            </section>
            <!-- SCRIPTS  -->
            <script type="text/javascript" src="js/new-ticket.js"></script>
        ';

    }
}
