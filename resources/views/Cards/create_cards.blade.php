<h1>Tambah Kartu</h1>

<a href="javascript:history.back()"><button>Kembali</button></a>

<br><br>

<form action="/cards" method="POST">
    @csrf

    <table border="0" cellpadding="5">
        <tr>
            <td><label>Nama Pemegang Kartu</label></td>
            <td><input type="text" name="cardholder_name" placeholder="Contoh: John Doe" style="width: 250px;"></td>
        </tr>
        <tr>
            <td><label>Tipe Kartu</label></td>
            <td>
                <select name="card_type" style="width: 250px;">
                    <option value="debit">Kartu Debit</option>
                    <option value="credit">Kartu Kredit</option>
                    <option value="prepaid">Kartu Prepaid</option>
                    <option value="virtual">Kartu Virtual</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 10px;">
                <button type="submit">Simpan</button>
            </td>
        </tr>
    </table>

</form>