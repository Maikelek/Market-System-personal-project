<form action="../backend/reserveItem.php" method="POST" class="d-inline">
    <input type="hidden" name="userID" value="<?=$id;?>"/>
    <button name="reserve" class='btn btn-success' value="<?=$data['itemID'];?>">Rezervuj</button>
</form>