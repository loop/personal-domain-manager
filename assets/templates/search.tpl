{include file="header.tpl"}
<div id="content">
<table width="100%" cellpadding="0" cellspacing="0" id="search">
    <tbody>
    <tr class="even">
      <td colspan="5">
	   <form action="./search.php" method="post">
	   <input type="text" name="domain_name" size="60" />
	   <input type="submit" name="search" value="Search" />
	   </form>
	   </td>
    </tr>
    </tbody>
  </table>
{if $domains_total != 0}
<table width="100%">
    <thead>
      <tr class="odd">
        <th scope="col">Domain</th>
        <th scope="col">Registered</th>
        <th scope="col">Expires</th>
        <th scope="col">Status</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
	{foreach item="d" from=$domains}
    <tr class="{cycle values="even,odd"}">
      <td><a href="http://{$d.domain}" target="_blank">{$d.domain}</a></td>
      <td>{$d.registered}</td>
      <td>{$d.expires}</td>
      <td>{if $d.status == 'expired'}<span style="color:red;">{$d.status|capitalize}</span>{elseif $d.status == 'expiring'}<span style="color:orange;">{$d.status|capitalize}</span>{else}<span style="color:green;">{$d.status|capitalize}</span>{/if}</td>
      <td><a href="{$config.paths.base_url}/index.php?action=delete_domain&id={$d.id}" onClick="return confirm('Delete?');" title="Delete Domain"><img src="./assets/images/cross.png" width="16" height="16" alt="Delete" /></a></td>
    </tr>
	{/foreach}
    </tbody>
  </table>
  {else}
  <div class="info">Sorry but your search returned no matches, please try again using a keyword (eg: mydom.com or mydomain)</div>
  {/if}
  <p><a href="{$config.paths.base_url}/" title="Home"><img src="./assets/images/home.png" width="16" height="16" alt="Home" /></a>&nbsp;<a href="{$config.paths.base_url}/add.php" title="Add Domain"><img src="./assets/images/add.png" width="16" height="16" alt="Add Domain" /></a>&nbsp;<a href="{$config.paths.base_url}/logout.php" title="Logout" onclick="return confirm('Logout?');"><img src="./assets/images/logout.png" width="16" height="16" alt="Logout" /></a></p>
</div>
{include file="footer.tpl"}