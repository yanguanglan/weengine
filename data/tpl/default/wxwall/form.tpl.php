<?php defined('IN_IA') or exit('Access Denied');?><style>
#item-form th{width:110px !important;}
.grid-5{width:400px !important;}
</style>
<div class="list" id="append-list">
    <div class="item on new_add">
        <div id="item-main">
            <div class="form" id="item-form">
            	<input type="hidden" name="reply_id" value="<?php echo $reply['id'];?>" />
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tbody>
                    	<?php if($reply['rid']) { ?>
                    	<tr>
                            <th>查看内容</th>
                            <td><a href="<?php echo create_url('index/module', array('do' => 'detail', 'name' => 'wxwall', 'id' => $reply['rid']))?>" target="_blank">查看内容</a>&nbsp;&nbsp;<a href="<?php echo create_url('index/module', array('do' => 'manage', 'name' => 'wxwall', 'id' => $reply['rid']))?>" target="_blank">审核内容</a></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th>退出指令</th>
                            <td><input type="text" value="<?php echo $reply['quit_command'];?>" class="txt grid-5 alpha pin" name="quit-command">
                                <div class="notice">用户退出话的指令，如果未设置则默认为“退出”</div></td>
                        </tr>
                    	<tr>
                            <th>是否审核</th>
                            <td>
                            	<input type="radio" name="isshow" value="1" id="isshow_1" <?php if($reply['isshow'] == '1') { ?>checked="true"<?php } ?>><label for="isshow_1">是</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="isshow" value="0" id="isshow_0"  <?php if($reply['isshow'] == '0') { ?>checked="true"<?php } ?>><label for="isshow_0">否</label>
                                <div class="notice">当用户在话题中发表内容，是否需要审核，为否为则直接显示内容。</div></td>
                        </tr>

                        <tr>
                            <th>进入提示</th>
                            <td><textarea style="height:150px;" name="enter-tips" class="txt content grid-5 alpha pin" cols="60"><?php echo $reply['enter_tips'];?></textarea>
                            	<div class="notice">当用户进入此话题时，返回用户的提示信息。</div></td>
                        </tr>
                        <tr>
                            <th>退出提示</th>
                            <td><textarea style="height:150px;" name="quit-tips" class="txt content grid-5 alpha pin" cols="60"><?php echo $reply['quit_tips'];?></textarea>
                                <div class="notice">当用户主动退出或是超时退出话题时，返回用户的提示信息。</div></td>
                        </tr>
                        <tr>
                            <th>发表提示</th>
                            <td><textarea style="height:150px;"  name="send-tips" class="txt content grid-5 alpha pin" cols="60"><?php echo $reply['send_tips'];?></textarea>
                                <div class="notice">当用户在话题发表内容成功时，返回用户的提示信息。</div></td>
                        </tr>
                        <tr>
                            <th>超时时间</th>
                            <td><input type="text" value="<?php echo $reply['timeout'];?>" class="txt grid-5 alpha pin" name="timeout">
                                <div class="notice">当用户在话题中未发表内容，并达到此选项设置的时间时，用户自动被踢出话题。单位秒（S）</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>