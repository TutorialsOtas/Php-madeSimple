<form action="/activities" method="POST">
    @csrf
    <input name="member_name" placeholder="Member name"><br>
    <input name="title" placeholder="Activity title"><br>
    <textarea name="details" placeholder="Details"></textarea><br>
    <input name="sms_count" type="number" placeholder="Daily SMS count"><br>
    <input name="sms_account_from_logs" type="number" placeholder="SMS from logs"><br>
    <input name="activity_date" type="date"><br>
    <button type="submit">Save</button>
</form>
