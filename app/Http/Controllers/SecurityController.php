<?php

class SecurityController
{

    public function deleteUser()
    {
        global $mysqli;

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $check = $mysqli->prepare("SELECT id FROM users WHERE id = ?");
            $check->bind_param("i", $id);
            $check->execute();
            $check->store_result();

            if ($check->num_rows === 0) {

                echo "User not found!";
                echo "<br><a href='view_users.php'>Kembali ke daftar users</a>";

                $check->close();
                $mysqli->close();
                exit;
            }

            $check->close();

            $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {

                echo "User berhasil dihapus!";
                echo "<br><a href='view_users.php'>Kembali ke daftar users</a>";

            } else {

                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();

        } else {

            echo "ID tidak ditemukan!";
        }
    }


    public function login()
    {
        global $mysqli;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $mysqli->prepare(
                "SELECT id, username, password FROM users WHERE username = ?"
            );

            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                $user = $result->fetch_assoc();

                if ($password == $user['password']) {

                    echo "Login berhasil!";
                    echo "<br>Selamat datang di Digital Banking";

                } else {

                    echo "Password salah!";
                }

            } else {

                echo "Username tidak ditemukan!";
            }

            $stmt->close();
            $mysqli->close();
        }
    }


    public function verifyOTP()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $otp = $_POST['otp'];

            if ($otp == "123456") {

                echo "OTP valid. Transaksi berhasil.";

            } else {

                echo "OTP tidak valid!";
            }
        }
    }


    // LOGOUT
    public function logout()
    {
        session_start();
        session_destroy();

        echo "Logout berhasil!";
    }
}
?>