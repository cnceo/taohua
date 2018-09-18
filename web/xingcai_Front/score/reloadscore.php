<span class="scoreinfo"><li>1、您当前积分为<span style="    padding: 0 8px;
    margin: 0 5px;
    line-height: normal;
    background-color: #f07a64;
    border-color: #ea7059;
    cursor: pointer;
    border-radius: 2px;
    border: 1px solid transparent;
    text-align: center;
    color: #fff;"><?=$this->user['score']?></span>可以抽奖<span style="padding: 0 8px;
    margin: 0 5px;
    line-height: normal;
    background-color: #93d79b;
    border-color: #8cd595;
    cursor: pointer;
    border-radius: 2px;
    border: 1px solid transparent;
    text-align: center;
    color: #fff;"><?=$this->iff($this->user['score']<$this->dzpsettings['score'],0,intval($this->user['score']/$this->dzpsettings['score']))?></span>次；</li>
<li>2、每次抽奖需要<span style="padding: 0 8px;
    margin: 0 5px;
    line-height: normal;
    background-color: #a3b9ff;
    border-color: #9bb2fc;
    cursor: pointer;
    border-radius: 2px;
    border: 1px solid transparent;
    text-align: center;
    color: #fff;"><?=$this->dzpsettings['score']?></span>积分；</li></span>