<template>
	<div>
		<div class="row mt-5">
		
			<div class="col-md-4">

        		<div class="card border-info">
					<div class="card-header bg-light">
						<h4 v-if="!isEditing">
					  		Agregar Cliente
						</h4>
						<h4 v-if="isEditing">
					  		Editar Cliente
						</h4>
					</div>
          			<div class="card-body">
            			<div class="row">

                            <div class="col-md-7">
								<label for="nombre" class="font-weight-bold">
									Nombre
								  	<small v-if="data_errors.nombre != undefined" class="form-text error-input p-1 alert-danger fade show">
								    	{{ data_errors.nombre[0] }}
								  	</small>
								</label>
								<input
								    v-model="clientes.nombre"
								    placeholder="nombre"
								    class="form-control"
								    type="text"
								    >
						  		</input>
							</div>

                            <div class="col-md-5">
								<label for="lastname" class="font-weight-bold">
									Apellido
								  	<small v-if="data_errors.lastname" class="form-text error-input p-1 alert-danger fade show">
								    	{{ data_errors.lastname[0] }}
								  	</small>
								</label>
								<input
								    v-model="clientes.lastname"
								    placeholder="apellido"
								    class="form-control"
								    type="text"
								    >
						  		</input>
							</div>

                            <div class="col-md-7 mt-1">
                                <label for="email" class="font-weight-bold">
                                    Correo
                                    <small v-if="data_errors.email != undefined" class="form-text error-input p-1 alert-danger fade show">
                                        {{ data_errors.email[0] }}
                                    </small>
                                </label>
                                <input
                                v-model="clientes.email"
                                placeholder="Correo electronico"
                                class="form-control"
                                type="email"
                                >
                                </input>
                            </div>

                            <div class="col-md-5 mt-1">
                                <label for="phone" class="font-weight-bold">
                                    Teléfono
                                    <small v-if="data_errors.phone" class="form-text error-input p-1 alert-danger fade show">
                                        {{ data_errors.phone[0] }}
                                    </small>
                                </label>
                                <input
                                v-model="clientes.phone"
                                placeholder="Numero"
                                class="form-control"
                                type="text"
                                >
                                </input>
                            </div>

                            <div class="col-md-12 mt-1" v-if="!not_foto">
                                <label class="font-weight-bold">
                                    Foto
                                    <small v-if="data_errors.file != undefined" class="form-text error-input p-1 alert-danger fade show">
                                        {{ data_errors.file[0] }}
                                    </small>
                                </label>
                                <input 
                                    id="file"
                                    class="border p-file form-control"
                                    type="file"
                                    ref="file"
                                    v-on:change="handleFileUpload()">
                                </input>
                            </div>

                            <div class="col-md-7 mt-1">
                                <label for="role" class="font-weight-bold">
                                    Rol
                                    <small v-if="data_errors.role" class="form-text error-input p-1 alert-danger fade show">
                                        {{ data_errors.role[0] }}
                                    </small>
                                </label>
                                <select 
                                v-model="clientes.role"
                                placeholder="Selecciona un rol"
                                class="form-control minimal">
                                    <option value="Administrador"> Administrador </option>
                                    <option value="Cliente"> Cliente </option>
                                </select>
                            </div>

                            <div class="col-md-5 mt-1" v-if="!not_foto">
                                <label for="password" class="font-weight-bold">
                                    Contraseña
                                    <small v-if="data_errors.password" class="form-text error-input p-1 alert-danger fade show">
                                        {{ data_errors.password[0] }}
                                    </small>
                                </label>
                                <input
                                v-model="clientes.password"
                                placeholder="password"
                                class="form-control"
                                type="password"
                                >
                                </input>
                            </div>

                            <div class="col-md-4 mt-1">
				                <label for="activo" class="font-weight-bold">
				                 	Activo
				                </label>
				                <div class="input-group">
				                 	<label class="switch">
				                    	<input type="checkbox" value="" v-model="clientes.activo" :id="1">
				                    	<span class="slider round" :for="1">
				                    	</span>
				                  	</label>
				                </div>
				            </div>
					
							<div class="col-md-12 mt-2">
				                <button type="button" class="btn btn-primary btn-block" 
                                        @click="addCliente" v-if="!isEditing">
				                  Agregar
				                </button>
                                <button class="btn btn-secondary" type="button" @click="cancelarEdit()"v-if="isEditing">
			                        Cancelar
			                    </button>
				                <button class="btn btn-primary pull-right" type="button" @click="updateSucursal()" v-if="isEditing">
			                        Actualizar
			                    </button>
				            </div>

      					</div>
    				</div>
				</div>

			</div>

			<div class="col md-8">
				<div class="card border-info">
					<div class="card-header bg-light">
						<h4>
					  		Panel de clientes
						</h4>
					</div>
					<div class="card-body">
			
						<div class="row mt-1 media-query-consultar">
							<div class="col-md-12">
								<vuetable ref="vuetable"
									:api-url="'clientes/allshow'"
									track-by="id"
									:fields="fields"
									:css="css.table"
									:show-sort-icons="true"
									:per-page="10"
									pagination-path="meta"
									:append-params="moreParams"
									@vuetable:pagination-data="onPaginationData">

                                    <div slot="img-slot" slot-scope="props">
                                        <img    :src="'/images/fotos-users/'+props.rowData.foto" alt="" 
                                                class="img img-fluid zoom rounded style-img"
                                                v-if="props.rowData.faker == '0'">
                                        <img    :src="props.rowData.foto" alt="" 
                                                class="img img-fluid zoom rounded style-img"
                                                v-else>
                                    </div>

                                    <div slot="activo-slot" slot-scope="props">
                                        <activo-user
                                            :id_user="props.rowData.id"
                                            :user_activo="props.rowData.activo">
                                        </activo-user>
                                    </div>

                                    <div slot="opciones-slot" slot-scope="props">
                                        <button  class="btn inline-block" disabled="disabled"
                                            v-if="props.rowData.role === 'Administrador'" 
                                            @click="confirmarEliminar(props.rowData)" 
                                            data-toggle="tooltip" data-placement="top" 
                                            title="Eliminar"
                                            style="padding: 0px !important; font-size: 100% !important;">
				                            <i class="fa fa-trash text-danger fa-2x">
				                            </i>
				                        </button>
                                        <a  class="inline-block" 
                                            v-else
                                            @click="confirmarEliminar(props.rowData)" 
                                            data-toggle="tooltip" data-placement="top" 
                                            title="Eliminar">
				                            <i class="fa fa-trash text-danger fa-2x">
				                            </i>
				                        </a>
                                        <a class="text-info inline-block" @click="editCliente(props.rowData)">
				                            <i class="fa fa-edit text-info fa-2x">
      										</i>
				                        </a>
                                    </div>

	              				</vuetable>
	              				<div style="margin-top:10px">
						            <div style="float: right;">
						                <vuetable-pagination ref="pagination"
											:css="css.pagination"
											class="pull-right"
											@vuetable-pagination:change-page="onChangePage"
						                	>
						                </vuetable-pagination>
						            </div>
						        </div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Vuetable from "vuetable-2";
	import VuetablePagination from "../utils/VuetablePaginationBootstrap4.vue";
	import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
	import CssConfig from "../utils/TableStyles";
	import VueEvents from 'vue-events'
    import ActivoUser from './ActivoUser.vue';
	import moment from 'moment';
	Vue.use(VueEvents)
	export default {
		props: ['user', 'users'],
		components: {
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo,
            ActivoUser
		},
		data() {
			return {
				css: CssConfig,
				fields: [
					{
						name: "lastname",
						title: 'Cliente',
						titleClass: 'center',
						sortField: "lastname",
                        width: "15%"
					},
                    {
                        name: "img-slot",
                        title: 'Foto',
                        sortField: "foto",
                        titleClass: 'center'
                    },
                    {
						name: "phone",
						title: 'Tel',
						titleClass: 'center',
						sortField: "phone",
                        width: "15%"
					},
                    {
						name: "role",
						title: 'Rol',
						titleClass: 'center',
						sortField: "role",
                        width: "8%"
					},
                    {
						name: "email",
						title: 'Correo',
						titleClass: 'center',
						sortField: "email",
                        width: "15%"
					},
                    {
						name: "activo-slot",
						title: 'Activo',
						titleClass: 'center',
						sortField: "name",
                        width: "17%"
					},
                    {
                        name: "opciones-slot",
                        title: '#',
                        titleClass: 'center'
                    },
				],
				moreParams: {},
                file: '',
				clientes: {
				  nombre: '',
				  lastname: '',
				  email: '',
                  password: '',
                  phone: '',
                  activo: '',
                  role: ''
				},
				data_errors: [],
                isFull: false,
                isVer: false,
                isEditing: false,
                formData:{},
                not_foto: false
					
			}
		},
		created(){
		},
		methods: {

            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },

            verAdd(){
                this.isFull = true;
                this.isVer = true;
            },

            cancelarEdit(){
                this.isEditing = false;
                this.not_foto = false;
                this.file = '';
                this.clientes = { 
                    nombre: '',
                    lastname: '',
                    email: '',
                    password: '',
                    phone: '',
                    activo: '',
                    role: ''
                }
            },

            cancelarAdd(){
                this.isVer = false;
            },

			addCliente() {

                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('nombre', this.clientes.nombre);
                formData.append('lastname', this.clientes.lastname);
                formData.append('email', this.clientes.email);
                formData.append('activo', this.clientes.activo);
                formData.append('role', this.clientes.role);
                formData.append('phone', this.clientes.phone);
                formData.append('password', this.clientes.password);
                axios.post('/clientes/store',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                  }).then(res => {
					let response = res.data;
					this.$events.fire('filter-reset');
					this.$snotify.success(response.message, 'Correcto', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});
                    this.file = '';
					this.clientes = { 
						nombre: '',
					  	lastname: '',
					  	email: '',
                        password: '',
                        phone: '',
                        activo: '',
                        role: ''
					};
				}).catch(err => {
					let response = err.response.data;
					console.log(response);
					this.$snotify.error(response.message, 'Error', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});
					this.data_errors = err.response.data.errors;
				})

			},

            confirmarEliminar(cliente){

				this.$snotify.warning('Esta seguro de eliminarlo ?', 'Aviso', {
					timeout: 0,
					showProgressBar: false,
					closeOnClick: false,
					pauseOnHover: true,
					buttons: [
						{
							text: 'Si', 
							action: (toast) => {
								this.removeCliente(cliente)
								this.$snotify.remove(toast.id); 
							}, 
							bold: true
						},
						{
							text: 'Cancelar', 
							action: (toast) => {
								this.$snotify.remove(toast.id); 
							}, 
							bold: true
						},
					]
				});
				
			},

            removeCliente(cliente){

			    axios.delete('/cliente/'+cliente.id).then(res => {
			        this.onFilterReset();
			        let response = res.data;
			        let delete_row = {};
					delete_row = response.clientes;
					this.$events.fire('delete-rol', delete_row);
			        this.$snotify.success('Se elimino de la lista', 'Correcto', {
		                timeout: 4000,
		                showProgressBar: true,
		                closeOnClick: true,
		                pauseOnHover: true
		            });
			    }).catch(error => {
			        
			    });

			},

            editCliente(cliente){

				console.log("cliente:", cliente);
                this.isEditing = true;
                this.not_foto = true;
                this.file = cliente.foto;
                this.clientes = {
                    id: cliente.id,
                	nombre: cliente.name,
					lastname: cliente.lastname,
					email: cliente.email,
					phone: cliente.phone,
					activo: cliente.activo,
					role: cliente.role
                };
                console.log(this.clientes);

            },

            updateSucursal(){

                axios.put('/cliente/'+this.clientes.id, {
                  ...this.clientes
                }).then(res => {
                    this.isEditing=false;
					this.not_foto = false;
                    let response = res.data;
                    this.onFilterReset();
                    this.$snotify.success(response.message, 'Correcto', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});
                    this.file = '';
					this.clientes = { 
						nombre: '',
					  	lastname: '',
					  	email: '',
                        password: '',
                        phone: '',
                        activo: '',
                        role: ''
					};
                }).catch(err => {

                	let response = err.response.data;
                    this.$snotify.error(response.message, 'Error', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});
                    this.data_errors = err.response.data.errors;

                });

            },

			onFilterReset () {
                this.moreParams = {}
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },

            onPaginationData(paginationData) {
				this.$refs.pagination.setPaginationData(paginationData);
				//this.$refs.paginationInfo.setPaginationData(paginationData);
			},

			onChangePage (page) {
				this.$refs.vuetable.changePage(page)
			}

		},
		mounted() {
			this.$events.$on('filter-reset', e => this.onFilterReset())
        },
        computed: {
        	
        }
		
	}
	
</script>