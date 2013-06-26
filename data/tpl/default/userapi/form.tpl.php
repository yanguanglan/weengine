<?php defined('IN_IA') or exit('Access Denied');?><style>
#item-form th{width:110px !important;}
.grid-5{width:400px !important;}
</style>
<div class="list" id="append-list">
    <div class="item on new_add">
        <div id="item-main">
            <div class="form" id="item-form">
            	<input type="hidden" name="reply_id" value="<?php echo $row['id'];?>" />
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <th>接口地址</th>
                            <td><input type="text" value="<?php echo $row['apiurl'];?>" class="txt grid-5 alpha pin" name="apiurl">
                                <div class="notice">
                                <ol>
                                	<li>1. 接口地址为可以访问的URL地址，通过此地址返回回复数据。</li>
                                    <li>2. </li>
                                    <li>3. 添加此模块的规则后，只针对于单个关键字有效，如果需要全部路由给接口处理，则修改该模块的优先级顺序。</li>
                                </ol>
                                </div></td>
                        </tr>
                        <tr>
                            <th>默认回复文字</th>
                            <td><input type="text" value="<?php echo $row['default_text'];?>" class="txt grid-5 alpha pin" name="default-text">
                                <div class="notice">当接口无回复时，则返回用户此处设置的文字信息，优先级高于“默认回复URL”</div></td>
                        </tr>
                        <tr>
                            <th>默认回复URL</th>
                            <td><input type="text" value="<?php echo $row['default_apiurl'];?>" class="txt grid-5 alpha pin" name="default-apiurl">
                                <div class="notice">当接口无回复时，则调取此处设置的URL进行数据返回，优先级低于“默认回复文字”。</div></td>
                        </tr>
                        <tr>
                            <th>缓存时间</th>
                            <td><input type="text" value="<?php echo $row['cachetime'];?>" class="txt grid-5 alpha pin" name="cachetime">
                                <div class="notice">接口返回数据将缓存在微擎系统中的时限，默认为0不缓存。</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
