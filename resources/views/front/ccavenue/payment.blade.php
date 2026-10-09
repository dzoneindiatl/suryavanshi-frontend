<form method="POST" action="{{ env('CCAVENUE_URL') }}" id="ccavenueForm">
    <input type="hidden" name="encRequest" value="{{ $encryptedData }}">
    <input type="hidden" name="access_code" value="{{ $accessCode }}">
    <input type="hidden" name="command" value="initiateTransaction">
</form>

<script>
document.getElementById('ccavenueForm').submit();
</script>