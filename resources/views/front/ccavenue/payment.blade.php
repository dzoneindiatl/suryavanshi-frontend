<form method="POST" action="{{ $gatewayUrl }}" id="ccavenueForm">
    <input type="hidden" name="encRequest" value="{{ $encryptedData }}">
    <input type="hidden" name="access_code" value="{{ $accessCode }}">
</form>

<script>
document.getElementById('ccavenueForm').submit();
</script>