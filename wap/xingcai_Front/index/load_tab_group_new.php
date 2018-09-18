                
				<div class="tz_xz">
<?php
$sql       = "select groupName from {$this->prename}played_group where id=?";
$groupName = $this->getValue($sql, $this->groupId);

$sql     = "select id, name, playedTpl, enable  from {$this->prename}played where enable=1 and groupId=? order by sort";
$playeds = $this->getRows($sql, $this->groupId);
if (!$playeds) {
    echo '<td colspan="7" align="center">暂1无玩法</td>';
    return;
}
if (!$this->played)
    $this->played = $playeds[0]['id'];
?>
	<?php
if ($playeds)
    foreach ($playeds as $played) {
        if ($this->played == $played['id'])
            $tpl = $played['playedTpl'];
        if ($played['enable']) {
?>
	<a data_id="<?= $played['id'] ?>" href="#" tourl="/index.php/index/played_new/<?= $this->type ?>/<?= $played['id'] ?>" <?= ($played['id'] == $this->played) ? ' class="tag"' : '' ?> style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= $played['name'] ?></a>
	<?php
        }
    }
?>
                    </div>
                   
                
                    <div class="ball_list">
<div class="num-table" id="num-select">
<?php
if (!$played['enable']) {
    $this->display('index/game-played/un-open.php');
    return;
}
$this->display("index/game-played/$tpl.php");
?>
</div>
                    </div>