<?php
/**
 * Handles login, logout and status for users.
 */
class User
{
    private $db;
    private $name;
    private $acronym;
    private $isAuthenticated;

    /**
     * Constructor
     *
     * Sets the database and reads the user information from session, if any
     * user has logged in.
     *
     * @param void.
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->isAuthenticated = false;

        if(isset($_SESSION['user'])) {
            $this->name = $_SESSION['user']->name;
			$this->acronym = $_SESSION['user']->acronym;
			$this->isAuthenticated = true;
		}
    }

    /**
     * Logs in a user.
     *
     * Logs in a user if the acronym and password can be identified in the
     * database. At successful login, the user information is stored in session.
     * Sets that the user has logged in.
     *
     * @param  string $user the acronym of the user.
     * @param  string $password the password for the user.
     * @return void
     */
    public function login($user, $password)
    {
        $sql = "SELECT acronym, name FROM THE_USER_TABLE_IN_DB WHERE acronym = ? AND password = md5(concat(?, salt))";
        $params = array($user, $password);
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);

        if(isset($res[0])) {
            $_SESSION['user'] = $res[0];
            $this->name = $_SESSION['user']->name;
            $this->acronym = $_SESSION['user']->acronym;
		    $this->isAuthenticated = true;
        }
    }

    /**
     * Logs out a user.
     *
     * Logs out a user by unset the user in the session. Clears the user
     * information and sets that user is not logged in.
     *
     * @return void.
     */
    public function logout()
    {
        unset($_SESSION['user']);
        $this->name = "";
		$this->acronym = "";
		$this->isAuthenticated = false;
    }

    /**
     * Returns if a user has logged in.
     *
     * @return boolean true if a user has logged in, false otherwise.
     */
    public function isAuthenticated()
    {
        return $this->isAuthenticated;
    }

    /**
     * Returns the logged in users acronym.
     *
     * @return string the acronym of the logged in user.
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Returns the logged in users name.
     *
     * @return string the name of the logged in user.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get user login status.
     *
     * Returns a message about the users login status. If a user has logged
     * out, a message notice the user that for security the web browser should
     * be closed.
     *
     * @param boolean $hasUserLoggedIn true if a user recently has tried to log
     *                                 in, false otherwise.
     *
     * @return string the login status for a user.
     */
    public function getUserLoginStatus($isTryingToLogIn=false)
    {
        if($this->isAuthenticated()) {
          $output = "Du är inloggad som: {$this->acronym} ({$this->name})";
        }
        else {
            if ($isTryingToLogIn) {
                $output = "Inloggning misslyckades. Kontrollera användarnamn och lösenord!";
            } else {
                $output = "Du är INTE inloggad.";
            }
        }

        return $output;
    }

    /**
     * Get user logout status.
     *
     * Returns a message about the users logout status. If a user has logged
     * out, a message notice the user that for security the web browser should
     * be closed.
     *
     * @param boolean $hasUserLoggedOut true if a user recently has logged out,
     *                                  false otherwise.
     *
     * @return string the logout status for a user.
     */
    public function getUserLogoutStatus($hasUserLoggedOut=false)
    {
        if($this->isAuthenticated()) {
          $output = "Du är inloggad som: {$this->acronym} ({$this->name})";
        }
        else {
            if ($hasUserLoggedOut) {
                $output = "Du har loggat ut. Stäng ner webbläsaren som extra säkerhet!";
            } else {
                $output = "Du är INTE inloggad.";
            }
        }

        return $output;
    }
}
