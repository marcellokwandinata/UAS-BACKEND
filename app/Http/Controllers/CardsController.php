<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CardsController
{

    public function index()
    {
        global $mysqli;

        $cards = DB::table('cards')->get();
        // $stmt = $mysqli->prepare("SELECT * FROM cards ORDER BY created_at DESC");
        return view('cards_index', compact('cards'));

        $result = $stmt->get_result();
        $cards = [];

        while ($row = $result->fetch_assoc()) {
            $cards[] = $row;
        }

        $stmt->close();
        $mysqli->close();

        return $cards;
    }


    public function show()
    {
        global $mysqli;

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $stmt = $mysqli->prepare("SELECT * FROM cards WHERE id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 0) {

                echo "Kartu tidak ditemukan!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

                $stmt->close();
                $mysqli->close();
                exit;
            }

            $card = $result->fetch_assoc();

            $stmt->close();
            $mysqli->close();

            return $card;

        } else {

            echo "ID tidak ditemukan!";
        }
    }


    public function store()
    {
        global $mysqli;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id          = uniqid('', true);
            $user_id     = $_POST['user_id'];
            $card_number = $_POST['card_number'];
            $card_type   = $_POST['card_type'];
            $expired_at  = $_POST['expired_at'];
            $status      = $_POST['status'] ?? 'aktif';
            $created_at  = date('Y-m-d H:i:s');

            $check = $mysqli->prepare("SELECT id FROM cards WHERE card_number = ?");
            $check->bind_param("s", $card_number);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {

                echo "Nomor kartu sudah terdaftar!";
                echo "<br><a href='cards_create.php'>Kembali ke form</a>";

                $check->close();
                $mysqli->close();
                exit;
            }

            $check->close();

            $stmt = $mysqli->prepare(
                "INSERT INTO cards (id, user_id, card_number, card_type, expired_at, status, created_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param(
                "sssssss",
                $id,
                $user_id,
                $card_number,
                $card_type,
                $expired_at,
                $status,
                $created_at
            );

            if ($stmt->execute()) {

                echo "Kartu berhasil ditambahkan!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

            } else {

                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();
        }
    }


    public function update()
    {
        global $mysqli;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id         = $_POST['id'];
            $card_type  = $_POST['card_type'];
            $expired_at = $_POST['expired_at'];
            $status     = $_POST['status'];
            $updated_at = date('Y-m-d H:i:s');

            $check = $mysqli->prepare("SELECT id FROM cards WHERE id = ?");
            $check->bind_param("s", $id);
            $check->execute();
            $check->store_result();

            if ($check->num_rows === 0) {

                echo "Kartu tidak ditemukan!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

                $check->close();
                $mysqli->close();
                exit;
            }

            $check->close();

            $stmt = $mysqli->prepare(
                "UPDATE cards SET card_type = ?, expired_at = ?, status = ?, updated_at = ?
                 WHERE id = ?"
            );
            $stmt->bind_param(
                "sssss",
                $card_type,
                $expired_at,
                $status,
                $updated_at,
                $id
            );

            if ($stmt->execute()) {

                echo "Kartu berhasil diperbarui!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

            } else {

                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();
        }
    }


    public function delete()
    {
        global $mysqli;

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $check = $mysqli->prepare("SELECT id FROM cards WHERE id = ?");
            $check->bind_param("s", $id);
            $check->execute();
            $check->store_result();

            if ($check->num_rows === 0) {

                echo "Kartu tidak ditemukan!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

                $check->close();
                $mysqli->close();
                exit;
            }

            $check->close();

            $stmt = $mysqli->prepare("DELETE FROM cards WHERE id = ?");
            $stmt->bind_param("s", $id);

            if ($stmt->execute()) {

                echo "Kartu berhasil dihapus!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

            } else {

                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();

        } else {

            echo "ID tidak ditemukan!";
        }
    }


    public function blockCard()
    {
        global $mysqli;

        if (isset($_GET['id'])) {

            $id         = $_GET['id'];
            $status     = 'nonaktif';
            $updated_at = date('Y-m-d H:i:s');

            $check = $mysqli->prepare("SELECT id FROM cards WHERE id = ?");
            $check->bind_param("s", $id);
            $check->execute();
            $check->store_result();

            if ($check->num_rows === 0) {

                echo "Kartu tidak ditemukan!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

                $check->close();
                $mysqli->close();
                exit;
            }

            $check->close();

            $stmt = $mysqli->prepare(
                "UPDATE cards SET status = ?, updated_at = ? WHERE id = ?"
            );
            $stmt->bind_param("sss", $status, $updated_at, $id);

            if ($stmt->execute()) {

                echo "Kartu berhasil diblokir!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

            } else {

                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();

        } else {

            echo "ID tidak ditemukan!";
        }
    }


    public function unblockCard()
    {
        global $mysqli;

        if (isset($_GET['id'])) {

            $id         = $_GET['id'];
            $status     = 'aktif';
            $updated_at = date('Y-m-d H:i:s');

            $check = $mysqli->prepare("SELECT id FROM cards WHERE id = ?");
            $check->bind_param("s", $id);
            $check->execute();
            $check->store_result();

            if ($check->num_rows === 0) {

                echo "Kartu tidak ditemukan!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

                $check->close();
                $mysqli->close();
                exit;
            }

            $check->close();

            $stmt = $mysqli->prepare(
                "UPDATE cards SET status = ?, updated_at = ? WHERE id = ?"
            );
            $stmt->bind_param("sss", $status, $updated_at, $id);

            if ($stmt->execute()) {

                echo "Kartu berhasil diaktifkan kembali!";
                echo "<br><a href='cards.php'>Kembali ke daftar kartu</a>";

            } else {

                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();

        } else {

            echo "ID tidak ditemukan!";
        }
    }
}
?>