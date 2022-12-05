        <?php
        session_start();

            if (isset($_POST['submit']))
            {
                $mail = $_POST['mail'];
                $pass = $_POST['pass'];

                $db = new PDO('mysql:host=localhost;dbname=animodo', 'root', '');

                $sql = "SELECT * FROM user where mail = '$mail'";
                $result = $db->prepare($sql);
                $result->execute();

                if ($result->rowCount() > 0)
                {
                    $data = $result->fetchAll();
                    if (password_verify($pass, $data[0]['password']))
                    {
                        echo "Connexion efféctué";
                        $_SESSION['mail'] = $mail;
                    }
                }
                else
                {
                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO user (mail, password) VALUES ('$mail','$pass')";
                    $req = $db->prepare($sql);
                    $req->execute();
                    echo "Vous êtes inscrit";
                }
            }
