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


            <h1>Ticket</h1>
            <span class="breadcrumb">
                Home / <a href="?">Tickets</a> / view
            </span>
            <div class="panel view-ticket">
                <header>
                    <a class="button" href="?edit='.$id.'">
                        <li class="fa fa-pencil"></li>
                    </a>
            ';
        if($row['working_on'] == $this->user['id']){

            echo '

                    <a class="button" href="?working_on='.$id.'">
                        <li class="fa fa-upload"></li>
                    </a>
            ';
        }else{
            echo '

                    <a class="button" href="?working_on='.$id.'">
                        <li class="fa fa-download"></li>
                    </a>
            ';
        }

        echo '
                    <a class="button" href="?delete='.$id.'">
                        <li class="fa fa-trash-o"></li>
                    </a>
                </header>
                <article class="info">
                    <h2 style="font-weight:400;">'.$row["subject"].'</h3>
                    '.$row["published"].'<br />
                    Van: <a href="mailto:'.$row["email"].'">'.$row["email"].'</a>
                </article>
                <article class="message">
                    '.$row['message'].'
                </article>
            </div>
        ';

    }

    public function getAll(){

        if($this->user['role'] == 2){
            $result = $this->db->doquery("SELECT * FROM {{table}} LIMIT 0,20","tickets");
            $nums = $this->db->doquery("SELECT user FROM {{table}} LIMIT 0,1000","tickets");
        }elseif($this->user['role'] == 1){
            $result = $this->db->doquery("SELECT * FROM {{table}} WHERE working_on='".$this->user['id']."' OR working_on=NULL LIMIT 0,20","tickets");
            $nums = $this->db->doquery("SELECT user FROM {{table}} WHERE working_on='".$this->user['id']."' OR working_on=NULL LIMIT 0,1000","tickets");
        }else{

            $result = $this->db->doquery("SELECT * FROM {{table}} WHERE user='".$this->user['id']."' LIMIT 0,20","tickets");
            $nums = $this->db->doquery("SELECT user FROM {{table}} WHERE user='".$this->user['id']."' LIMIT 0,1000","tickets");
        }
        echo '

            <h1>Tickets('.mysqli_num_rows($nums).')</h1>
            <span class="breadcrumb">
                Home / Tickets
            </span>
            <div class="panel view-ticket">
                <header>
                    <div class="settings">
                        <i class="fa fa-cog"></i>
                        <i class="fa fa-caret-down"></i>
                    </div>
                    <a class="button" id="deleteAll">
                        <li class="fa fa-trash-o"></li>
                    </a>
                </header>
                <table>
                    <tr>
                        <th><i class="fa fa-square-o checkBox" onclick="changeCheckAll(this)" style="cursor: pointer;"></i></th>
                        <th>Ticket</th>
                        <th>Subject</th>
                        <th>Department</th>
                        <th>Priority</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th></th>
                    </tr>
            ';




        while($row = mysqli_fetch_array($result)){
            echo '
            <tr class="active">
                <td><i class="fa fa-square-o checkBox" onclick="changeCheck(this)" style="cursor: pointer;"></i></td>
                    <td>'.$row["id"].'</td>
                    <td>'.$row["subject"].'</td>
                    <td>'.$row["department"].'</td>
                    <td>'.$row["priority"].'</td>
                    <td>'.$row["email"].'</td>
                    <td>'.$row["status"].'</td>
                    <td>'.$row["published"].'</td>
                    <td><a href="?view=' . $row['id'] . '" class="fa fa-eye"></a></td>
                <td></td>
            </tr>
          ';
        }
        echo '

                </table>
            </div>

	';
    }
    public function delete($id){

        $r = $this->db->doquery("SELECT id FROM {{table}} WHERE id='$id'","tickets");
        if(mysqli_num_rows($r) > 0){
            $this->db->doquery("DELETE FROM {{table}} WHERE id='$id' ","tickets");
        }
    }
    public function workingOn($id){

        $r = $this->db->doquery("SELECT id,working_on FROM {{table}} WHERE id='$id'","tickets");

        if(mysqli_num_rows($r) > 0){
            $row = mysqli_fetch_array($r);
            if($row['working_on'] == $this->user['id']){
                $this->db->doquery("UPDATE {{table}} SET working_on=NULL WHERE id='$id' ","tickets");
            }else{
                $this->db->doquery("UPDATE {{table}} SET working_on='".$this->user['id']."' WHERE id='$id' ","tickets");
            }
        }
        $this->core->loadPage("?view=$id");
    }
    public function edit($id){

        $r = $this->db->doquery("SELECT * FROM {{table}} WHERE id='$id'","tickets");
        $row = mysqli_fetch_array($r);

        echo '

        <div class="panel">
            <article>
            <form method="post" action="?edit='.$id.'">
        ';

        if(isset($_POST['editTicket'])){
            $subject = $this->db->esc_str($_POST['subject']);
            $mail = $this->db->esc_str($_POST['email']);
            $department = $this->db->esc_str($_POST['department']);
            $description = $this->db->esc_str($_POST['description']);

            $errors = 0;
            if(isset($_POST['priority'])){
                $priority = $this->db->esc_str($_POST['priority']);
            }else{
                $priority = false;
                echo "Geen prioriteit gekozen.<br />";
                $errors++;
            }
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
                $this->db->doquery("UPDATE {{table}} SET subject='$subject', message='$description', department='$department', priority='$priority', email='$mail' WHERE id='$id'", "tickets");

                $r = $this->db->doquery("SELECT * FROM {{table}} WHERE id='$id'","tickets");
                $row = mysqli_fetch_array($r);
                echo "Succesvol aangepast.<br />";
                $this->getForm($row['subject'], $row['email'], $row['priority'], $row['department'], $row['message']);

            }else{
                $this->getForm($subject, $mail, $priority, $department, $description);
            }

        }else{

            $this->getForm($row['subject'], $row['email'], $row['priority'], $row['department'], $row['message']);
        }
        echo '
                <input class="send" type="submit" value="Aanpassen" name="editTicket"/>
            </form>
            </article>
        </div>
        ';
    }
    public function newTicket(){
        echo '

            <section id="formblock">
                <h1 id="stelvraag">Stel uw vraag!</h1>
                <p>Door het formulier hieronder in te vullen kunt u uw vraag of klacht bij ons neerleggen.
                    U krijgt meestal binnen 24 uur antwoord, het kan maximaal 5 dagen duren.
                  <form method="post" id="contactForm" action="">
          ';

            if(isset($_POST['newTicket'])){
                $subject = $this->db->esc_str($_POST['subject']);
                $mail = $this->db->esc_str($_POST['email']);
                $department = $this->db->esc_str($_POST['department']);
                $description = $this->db->esc_str($_POST['description']);

                $errors = 0;
                if(isset($_POST['priority'])){
                    $priority = $this->db->esc_str($_POST['priority']);
                }else{
                    $priority = false;
                    echo "Geen prioriteit gekozen.<br />";
                    $errors++;
                }
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
                    $this->core->loadPage('index.php?view='.$id.'&flash=Ticket%20toegevoegd.');
//                    echo '<script type="text/javascript">
//                               window.location = "";
//                          </script>';
                    $this->getForm();

                }else{
                    $this->getForm($subject, $mail, $priority, $department, $description);
                }

            }else{

                $this->getForm();
            }
        echo '
                <input class="send" type="submit" value="Verstuur" name="newTicket"/>
            </form>
            </section>
            <section id="QA">
                <h1 id="stelvraag">Veelgestelde vragen</h1>
                <p>Voor u uw vraag stelt kunt u ook kijken of uw vraag hier tussenstaat.
                    Zo voorkom je dat je moet wachten op je vraag!
              <ul>
                <li class="question">Wanneer kan ik antwoord verwachten?<i class="fa fa-angle-down right"></i></li>
                <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                         Maecenas a mattis augue.
                        Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Wat houdt de prioriteit in en wat vul ik daar in?<i class="fa fa-angle-down right"></i></li>
                  <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                             Maecenas a mattis augue.
                            Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Hoe weet ik naar welke afdeling mijn probleem moet?<i class="fa fa-angle-down right"></i></li>
                  <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                                 Maecenas a mattis augue.
                                Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Ik kan niet inloggen wat kan ik nu doen?<i class="fa fa-angle-down right"></i></li>
                    <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                             Maecenas a mattis augue.
                            Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
                    <li class="question">Hoe kan ik me afmelden voor de helpservice?<i class="fa fa-angle-down right"></i></li>
                    <li class="answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis eu felis vel pellentesque.
                             Maecenas a mattis augue.
                                Nullam mollis scelerisque elit ut iaculis. Nullam sit amet tincidunt ex. </li>
              </ul>
            </section>
            <!-- SCRIPTS  -->
            <script type="text/javascript" src="js/new-ticket.js"></script>
        ';

    }
    public function getForm($subject=false, $email=false, $priority=false,$department=false, $description=false){
        echo '

                <div class="form">
                    <label>Onderwerp</label>
                    <input type="text" placeholder="Onderwerp" name="subject" value="'.($subject ? $subject : "").'"/>
                </div>
                <div class="form">
                    <label>Email Adres</label>
                    <input type="email" placeholder="Email Adres" name="email" value="'.($email ? $email : "").'" />
                </div>
                <div class="form">
                    <select name="priority">
                        <option value="" disabled '.($priority ? "" : "selected").'>Prioriteit</option>
                        <option value="3" '.($priority == 3 ? "selected" : "").' >High</option>
                        <option value="2" '.($priority == 2 ? "selected" : "").' >Medium</option>
                        <option value="1" '.($priority == 1 ? "selected" : "").' >Low</option>
                    </select>
                </div>
                <div class="form">
                    <label for="department">Department</label>
                    <input type="text" placeholder="Afdeling" name="department" value="'.($department ? $department : "").'" />
                </div>
                <div class="form">
                    <label>Toelichting</label>
                    <textarea rows="5" placeholder="Toelichting" name="description">'.($description ? $description : "").'</textarea>
                </div>
                <br />
            ';
    }
}
