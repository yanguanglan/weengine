<?php defined('IN_IA') or exit('Access Denied');?><?php include template('common/header', TEMPLATE_INCLUDEPATH);?>
    <div id="main-column" class="container-12 clearfix member-center">
        <div class="column2 grid-3 alpha omega">
            <?php include template('rule/nav', TEMPLATE_INCLUDEPATH);?>
        </div>
        <script type="text/javascript">var formCheckers = [];</script>
        <div class="column1 grid-10 alpha omega">
            <div class="form">
				<div class="form_h">
					<h6>添加规则<span>删除，修改规则、关键字以及回复后，请提交规则以保存操作。</span></h6>
				</div>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
				<input type="hidden" name="id" value="<?php echo $rule['rule']['id'];?>">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<th>规则名称：</th>
						<td>
							<input type="text" name="name" class="txt grid-4 alpha pin" value="<?php echo $rule['rule']['name'];?>" />
							<div class="notice">您可以给这条规则起一个名字, 方便下次修改和查看. </div>
						</td>
					</tr>
                    <tr>
						<th>规则类别：</th>
						<td>
							<select name="cate_1" onchange="fetch_category(this.options[this.selectedIndex].value)">
                            	<option value="0">请选择一级分类</option>
                                <?php if(is_array($category)) { foreach($category as $row) { ?>
                                <?php if($row['parentid'] == 0) { ?>
                                <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $rule['rule']['cate']['0']) { ?> selected="selected"<?php } ?>><?php echo $row['name'];?></option>
                                <?php } ?>
                                <?php } } ?>
                            </select>
                            <select name="cate_2" id="cate_2">
                            	<option value="0">请选择二级分类</option>
                            </select>
						</td>
					</tr>
					<tr>
						<th>回复类型：</th>
						<td>
						<?php if(empty($id)) { ?>
						<select name="module" id="module" onchange="module_display(this.options[this.selectedIndex].value);$(this).next().html($(this.options[this.selectedIndex]).attr('description'));;">
							<?php if(is_array($_W['setting']['modules'][$_W['weid']])) { foreach($_W['setting']['modules'][$_W['weid']] as $key => $mod) { ?>
                            <?php if(!empty($mod['rulefields'])) { ?>
							<option value="<?php echo $key;?>" description="<?php echo $mod['description'];?>"><?php echo $mod['title'];?></option>
                            <?php } ?>
							<?php } } ?>
						</select>
						<div class="notice"><?php echo $_W['setting']['modules']['basic']['description'];?></div>
						<?php } else { ?>
						<div><?php echo $_W['setting']['modules'][$rule['rule']['module']]['title'];?></div>
						<div class="notice"><?php echo $_W['setting']['modules'][$rule['rule']['module']]['description'];?></div>
						<?php } ?>
						</td>
					</tr>
					<tr>
                    <th>关键字：</th>
					<td>
						<input name="keyword-add" type="button" value="添加" onclick="keyword_add()" class="btn alpha" />
						<div class="notice">根据此处设置的关键字进行对应回复，可设置多个。</div>
						<div id="keyword-list" class="list">
							<?php if(is_array($rule['keyword'])) { foreach($rule['keyword'] as $row) { ?>
								<div id="item-<?php echo $row['id'];?>" class="item clearfix">
									<div class="content">
										<div class="data fl">
										<input type="hidden" id="keyword-value" value="<?php echo $row['content'];?>" name="keyword[<?php echo $row['id'];?>]">
										<input type="hidden" id="type-value" value="<?php echo $row['type'];?>" name="type[<?php echo $row['id'];?>]">
										<label for="label_<?php echo $row['id'];?>" id="keyword-name"><?php echo $row['content'];?></label>&nbsp;（<span  id="type-name"><?php echo $types[$row['type']];?></span>）</div>
										<span id="confirm-delete"><a onclick="keyword_delete(this.id, true)" id="<?php echo $row['id'];?>" href="javascript:;" class="fr">删除</a><a style="margin-right:5px;" onclick="keyword_edit(this.id)" id="<?php echo $row['id'];?>" href="javascript:;" class="fr">编辑</a></span>

									</div>
								</div>
							<?php } } ?>
						</div>
					</td>
					</tr>
					<tr>
						<th>回复：</th>
						<td id="reply-content">
						<?php if(!empty($id)) { ?>
						<?php $rule['reply']->fieldsFormDisplay($rule['rule']['id']);?>
						<?php } else { ?>
						<script type="text/javascript">
						$(function(){
							module_display($('#module')[0].options[$('#module')[0].selectedIndex].value);
							$('select').val(0);
						});
						</script>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<th></th>
						<td>
							<input name="submit" type="submit" value="提交" class="btn grid-2 alpha" />
							<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
						</td>
					</tr>
				</table>
                </form>
            </div> 
        </div>
        <div id="keyword-add-dialog" class="form" style="display:none;">
            <div class="clearfix form">
			<table>
				<tr>
					<th>关键字</th>
					<td>
						<input type="text" id="keyword-add-text" style="width:300px;" class="txt grid-4 alpha pin" />
						<div class="notice">根据此处设置的关键字进行对应回复，可设置多个。<a class="iconEmotion" href="javascript:;" inputId="keyword-add-text">表情</a></div>
					</td>
				</tr>
				<tr>
					<th>对应方式</th>
					<td>
						<input type="radio" name="keyword-add-type" value="1" description="用户进行微信交谈时，对话内容完全等于上述关键字才会执行这条规则。" id="keyword-add-type-1"  checked="checked"/><label for="keyword-add-type-1">完全等于上述关键字</label>&nbsp;&nbsp;<input type="radio" name="keyword-add-type" value="2" description="用户进行微信交谈时，对话中包含上述关键字就执行这条规则。" id="keyword-add-type-2"/><label for="keyword-add-type-2">包含上述关键字</label>&nbsp;&nbsp;<input type="radio" name="keyword-add-type" value="3" description="用户进行微信交谈时，对话内容符合述关键字中定义的模式才会执行这条规则。<br /><i>/^微擎/</i>匹配以“微擎”开头的语句<br /><i>/微擎$/</i>匹配以“微擎”结尾的语句<br /><i>/^微擎$/</i>匹配等同“微擎”的语句<br /><i>/微擎/</i>匹配包含“微擎”的语句<br /><i>/[0-9\.\-]/</i>匹配所有的数字，句号和减号<br /><i>/^[a-zA-Z_]$/</i>所有的字母和下划线<br /><i>/^[[:alpha:]]{3}$/</i>所有的3个字母的单词<br /><i>/^a{4}$/</i>aaaa<br /><i>/^a{2,4}$/</i>aa，aaa或aaaa<br /><i>/^a{2,}$/</i>匹配多于两个a的字符串" id="keyword-add-type-3" /><label for="keyword-add-type-3">正则表达式匹配<span style="font-size:12px;">（高级用户）</span></label>
						<div class="notice"></div>
					</td>
				</tr>
				<tr>
					<th></th>
					<td><input name="keyword-add" type="button" value="提交" onclick="keyword_add_handler()" class="mt10 btn grid-2 alpha" /></td>
				</tr>
			</table>
			</div>
        </div>
        
    </div>

    <script type="text/javascript">
        $(function(){
            $(':radio[name="keyword-add-type"]').click(function(){
                if($(this).attr('checked')) {
                    $(this).nextAll('div').html($(this).attr('description'));
                }
            });
			<?php if($rule['rule']['cate']['1']) { ?>
			fetch_category('<?php echo $rule['rule']['cate']['0'];?>', '<?php echo $rule['rule']['cate']['1'];?>');
			<?php } ?>
        });
        var deleteid = 0;
        function add_dialog(id, title) {
            var d = $('#'+id).dialog({modal:true, title:title, width:700, autoOpen:false});
            d.dialog('open');
        }

        function keyword_add_handler() {
            var typelabels = [<?php echo $typeslabel;?>];
            var type = $('input:radio[name="keyword-add-type"]:checked').val();
            if ($('#keyword-add-text').val() == '') {
                alert('请输入关键字！');
                return false;
            }
            if (deleteid) {
                var curitem = $(document.getElementById('item-'+deleteid));
                curitem.find('#keyword-value').val($('#keyword-add-text').val());
                curitem.find('#type-value').val(type);
                curitem.find('#keyword-name').html($('#keyword-add-text').val());
                curitem.find('#type-name').html(typelabels[type]);   
                deleteid = 0;
            } else {
                var id = Math.random();
                var html = '<div class="item clearfix" id="item-'+id+'"><div class="content"><div class="data fl">'+
                '<input type="hidden" name="keyword-new[]" value="'+$('#keyword-add-text').val()+'" id="keyword-value" /><input type="hidden" name="type-new[]" value="'+type+'" id="type-value" />'+
                //'<input type="checkBox" id="label_'+id+'">&nbsp;'+
                '<label for="label_'+id+'" id="keyword-name">'+$('#keyword-add-text').val()+'</label>&nbsp;（<span  id="type-name">'+typelabels[type]+'</span>）</div>'+
                '<a class="fr" href="javascript:;" id="'+id+'" onclick="keyword_delete(this.id)">删除</a>'+
                '<a class="fr" href="javascript:;" id="'+id+'" onclick="keyword_edit(this.id)" style="margin-right:5px;">编辑</a>'+  
                '</div>';
                $('#keyword-list').append(html);
            }
            $('#keyword-add-text').val('');
            $('#keyword-add-dialog').dialog('close');
        }

        function keyword_delete(id, ispost) {
			if(!confirm('删除操作不可恢复，确认删除吗？')) {
				return false;		
			}
			if (ispost) {
				$.getJSON('rule.php?act=delete&type=keyword&rid=<?php echo $rule['rule']['id'];?>&kid='+id, function(data){
					if (data.type == 'success') {
						$('#item-'+id).remove();	
					} else {
						message(data.message, data.redirect, data.type);
					}
				});
			} else {
				$(document.getElementById('item-'+id)).remove();
			}
        }

        function keyword_edit(id) {
            var curitem = $(document.getElementById('item-'+id));
            var keywordvalue = curitem.find('#keyword-value').val();
            var typevalue = curitem.find('#type-value').val();
            $('#keyword-add-text').val(keywordvalue);
            $('input:radio[name="keyword-add-type"]').attr('checked', false);
            $('input:radio[name="keyword-add-type"]:[value='+typevalue+']').attr('checked', true);
            deleteid = id;
            add_dialog('keyword-add-dialog', '规则管理');
            $(':radio[name="keyword-add-type"]:checked').trigger('click');
        }

        function keyword_add() {
            $('#keyword-add-text').val('');
            deleteid = 0;
            add_dialog('keyword-add-dialog', '规则管理');
        }

        function module_display($name) {
            try {
                $.ajax({
                  url: "<?php echo create_url('setting/module', array('do' => 'form', 'id' => $rule['rule']['id']))?>",
                  type: "GET",
                  data: {'name' : $name},
                  dataType: "html"
                }).done(function(s) {
                    formCheckers = [];
                    $('#reply-content').html(s);
                });    
            }
            catch (e) {
            }
        }

        function formcheck(form) {
            if (form['name'].value == '') {
                message('抱歉，规则名称为必填项，请返回修改！');
                return false;
            }
            for(var i = 0; i < formCheckers.length; i++) {
                if($.isFunction(formCheckers[i])) {
                    if(formCheckers[i]() === false) {
                        return false;
                    }
                }
            }
            return true;
        }
		
		function fetch_category(parentid, childid) {
			parentid = parentid ? parentid : 0;
			$.getJSON('setting.php?act=category&do=fetch&parentid='+parentid, function(s){
				if (s) {
					$('#cate_2').empty();
					$('#cate_2').append('<option value="0">请选择二级分类</option>');
					for (i in s.message) {
						$('#cate_2').append('<option value="'+s.message[i]['id']+'" '+(s.message[i]['id'] == childid ? 'selected ' : '')+'>'+s.message[i]['name']+'</option>');	
					}		
				}
			});
		}
    </script>
<?php include template('common/footer', TEMPLATE_INCLUDEPATH);?>
