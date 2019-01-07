<template>
	<div class="container">
		<h2>
			Users Listings
		</h2>
		    <form class="form-horizontal" v-on:submit.prevent="addNewUser()">

              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name" v-model="name">
                <label for="inputPassword">Nama</label>
              </div>

              <div class="form-group">
                <input type="email" name="email" v-model="email" class="form-control" placeholder="Email address">
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-group">
                <input type="password" name="password" v-model="password" id="inputPassword" class="form-control" placeholder="Password">
                <label for="inputPassword">Password</label>
              </div>


              <div class="form-group">
                <input type="file" class="form-control" name="file" @change="imageChanged">
                <label for="inputPassword">Foto</label>
              </div>

              <button class="btn btn-lg btn-primary " type="submit">Save</button>
            </form>

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
			this.addNewUser();
		}, methods: {
			addNewUser() {
				axios.post('/api/users/',{
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
					this.image = e.target.result
				}
				
				console.log(this.image);
			}
			

		}
	}
</script>

<style>
</style>