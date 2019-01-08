<template>
	<div class="container">
		<h2>
			Create User
		</h2>
		<div class="box">
		    <form role="form" v-on:submit.prevent="addNewUser()">
			   <div class="box-body">

	              <div class="form-group">
	                <label for="inputPassword">Nama</label>
	                <input type="text" class="form-control" placeholder="Name" name="name" v-model="name">
	              </div>

	              <div class="form-group">
	                <label for="inputEmail">Email address</label>
	                <input type="email" name="email" v-model="email" class="form-control" placeholder="Email address">
	              </div>

	              <div class="form-group">
	                <label for="inputPassword">Password</label>
	                <input type="password" name="password" v-model="password" id="inputPassword" class="form-control" placeholder="Password">
	              </div>


	              <div class="form-group">
	                <label for="inputPassword">Foto</label>
	                <input type="file" name="file" @change="imageChanged">
	              </div>

	              <button class="btn btn-lg btn-primary " type="submit">Save</button>

        		</div>
            </form>
        </div>
	</div>

</template>


<script>
	export default {
		data(){
			return {
				name : '',
				email : '',
				password : '',
				csrf_token : $('meta[name="csrf-token"]').attr('content'),
				image : ''
			}
		},mounted(){
			//this.addNewUser();
		}, methods: {
			addNewUser() {
				axios.post('/api/users/simpan',{
					name: this.name,
					email: this.email,
					password: this.password,
					csrf_token:   this.csrf_token,
					image: this.image,
				} ).then(response => { 
					
					window.location.href = '/users';

				}).catch(error => {
					console.log(this.error);
				});
			},

			imageChanged(e){
				var fileReader = new FileReader();

				fileReader.readAsDataURL(e.target.files[0])
				fileReader.onload = (e) => {
					console.log(e.target.result);
					this.image = e.target.result
				}
				
				console.log(this.image);
			}
			

		}
	}
</script>

<style>
</style>