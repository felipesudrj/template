<?php 
$this->start('css');
echo $this->Html->css('pages/signin.css');
$this->end();
?>



<div class="account-container stacked">
	
	<div class="content clearfix">
		<?php echo $this->Form->create('Usuario');?>
		
			<h1>Área restrita</h1>		
			
			<div class="login-fields">
				
				
				
				<div class="field">
					<label for="username">Username:</label>
                                       <?php echo $this->Form->input('login',array('class'=>'form-control input-lg username-field','placeholder'=>"Login",'label'=>false,'div'=>false));?> 
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<?php echo $this->Form->input('senha',array('type'=>'password','class'=>'form-control input-lg password-field','placeholder'=>"Senha",'label'=>false,'div'=>false));?> 
                                       
				</div> <!-- /password -->
				
                                
                                <div class="field">
					
					<?php echo $this->Session->flash('mensagem');?> 
                                       
				</div>
                                
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				
									
				<button class="login-action btn btn-primary">Entrar</button>
				
			</div> <!-- .actions -->
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->



