{include file="header.tpl"}
<div id="content">
  <div id="add" class="clearfix">
    {if $is_error == 1}<div class="error">{$error_message}</div>{/if}
    <form action="{$config.paths.base_url}/add.php" method="post">
      <label for="domain">Domain</label>
      <input name="domain" id="domain" size="60" type="text" />
      <label for="registered">Registered (format: YYYY-MM-DD)</label>
      <input name="registered_year" type="text" id="registered" size="4" maxlength="4" />
      &nbsp;
	  <input name="registered_month" type="text" id="registered" size="2" maxlength="2" />
	  &nbsp;
	  <input name="registered_day" type="text" id="registered" size="2" maxlength="2" />
	  <label for="expires">Expires (format: YYYY-MM-DD)</label>
      <input name="expires_year" type="text" id="expires" size="4" maxlength="4" />
      &nbsp;
	  <input name="expires_month" type="text" id="expires" size="2" maxlength="2" />
	  &nbsp;
	  <input name="expires_day" type="text" id="expires" size="2" maxlength="2" />
	  <div class="info">If expire and regester dates are blank they will be filled from whois.</div>
      <hr>
      <input name="add" value="Add Domain" type="submit" />&nbsp;<input name="cancel" value="Cancel" type="button" onclick="location.href=('{$config.paths.base_url}');" />
    </form>
  </div>
</div>
{include file="footer.tpl"}