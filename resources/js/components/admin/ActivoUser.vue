<template>
	<div>
		<div class="input-group">
            <select 
            v-model="user_activo"
            placeholder="Selecciona un estatus"
            class="form-control minimal"
            @change="selectStatus()">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div> 
	</div>
</template>

<script>
	import Vue from 'vue';

	export default {
		props:['id_user', 'user_activo'],
		components: {},
		data() {
			return {
                user_activo: '',
				moreParams: {},
				url:''
			}
		},
        created(){
            console.log(this.user_activo);
        },
		methods: {

			selectStatus(){
				axios.post('/cliente/'+this.id_user+'/changeEstatus', {
                    user_activo: this.user_activo
                }).then(res => {
                    console.log(res);
                    this.$events.fire('filter-reset');
                    this.$snotify.success(res.data.message, 'Correcto', {
                        timeout: 4000,
                        showProgressBar: true,
                        closeOnClick: true,
                        pauseOnHover: true
                    });
                }).catch(error => {

                    this.$snotify.error(error.response.data.message, 'Incorrecto', {
                        timeout: 4000,
                        showProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true
                    });

                    this.data_errors = error.response.data.errors;
                    
                });

			}

		},
		
	}
</script>