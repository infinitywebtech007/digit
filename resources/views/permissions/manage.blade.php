@extends('layouts.app')

@section('subtitle', 'Permissions Management')
@section('content_header_title', 'Manage Permissions')
@section('content_header_subtitle', 'Manage Roles and Permissions')

@section('content_body')
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Add Roles to Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Add Permissions to Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Add Permissions to Users</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <!-- Tab 1: Add Roles to Users -->
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <div class="form-group">
                                <label for="user_select_roles">Select User</label>
                                <select class="form-control" id="user_select_roles" v-model="selectedUserForRoles">
                                    <option value="">Choose a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div v-if="selectedUserForRoles" class="mt-3">
                                <h5>Roles for @{{ getUserName(selectedUserForRoles) }}</h5>
                                <div class="row">
                                    <div class="col-md-4" v-for="role in allRoles" :key="role.id">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :id="'role_' + role.id" :value="role.name" v-model="userRoles" @change="toggleRole(role.name, $event.target.checked)">
                                            <label class="form-check-label" :for="'role_' + role.id">
                                                @{{ role.name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Add Permissions to Roles -->
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="form-group">
                                <label for="role_select_permissions">Select Role</label>
                                <select class="form-control" id="role_select_permissions" v-model="selectedRoleForPermissions">
                                    <option value="">Choose a role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div v-if="selectedRoleForPermissions" class="mt-3">
                                <h5>Permissions for @{{ getRoleName(selectedRoleForPermissions) }}</h5>
                                <div class="row">
                                    <div class="col-md-4" v-for="permission in allPermissions" :key="permission.id">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :id="'perm_role_' + permission.id" :value="permission.name" v-model="rolePermissions" @change="togglePermissionToRole(permission.name, $event.target.checked)">
                                            <label class="form-check-label" :for="'perm_role_' + permission.id">
                                                @{{ permission.name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3: Add Permissions to Users -->
                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <div class="form-group">
                                <label for="user_select_permissions">Select User</label>
                                <select class="form-control" id="user_select_permissions" v-model="selectedUserForPermissions">
                                    <option value="">Choose a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div v-if="selectedUserForPermissions" class="mt-3">
                                <h5>Permissions for @{{ getUserName(selectedUserForPermissions) }}</h5>
                                <div class="row">
                                    <div class="col-md-4" v-for="permission in allPermissions" :key="permission.id">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :id="'perm_user_' + permission.id" :value="permission.name" v-model="userPermissions" @change="togglePermissionToUser(permission.name, $event.target.checked)">
                                            <label class="form-check-label" :for="'perm_user_' + permission.id">
                                                @{{ permission.name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    {{-- Add here extra stylesheets --}}
@endpush

@push('js')
<script>
function showToast(message='test',type='success',title='title') {
    
    $(document).Toasts('create', {
      title: title,
      body: message,
      autohide: true,
      delay: 4000,
      position: 'topRight' ,
      class:'bg-success',
    })
}


</script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            selectedUserForRoles: '',
            selectedRoleForPermissions: '',
            selectedUserForPermissions: '',
            allRoles: [],
            allPermissions: [],
            userRoles: [],
            rolePermissions: [],
            userPermissions: [],
            users: @json($users),
            roles: @json($roles),
            permissions: @json($permissions)
        }
    },
    watch: {
        selectedUserForRoles(newVal) {
            if (newVal) {
                this.loadUserRoles(newVal);
            } else {
                this.userRoles = [];
            }
        },
        selectedRoleForPermissions(newVal) {
            if (newVal) {
                this.loadRolePermissions(newVal);
            } else {
                this.rolePermissions = [];
            }
        },
        selectedUserForPermissions(newVal) {
            if (newVal) {
                this.loadUserPermissions(newVal);
            } else {
                this.userPermissions = [];
            }
        }
    },
    methods: {
        getUserName(userId) {
            const user = this.users.find(u => u.id == userId);
            return user ? user.name : '';
        },
        getRoleName(roleId) {
            const role = this.roles.find(r => r.id == roleId);
            return role ? role.name : '';
        },
        loadUserRoles(userId) {
            fetch(`/api/user-roles/${userId}`)
                .then(response => response.json())
                .then(data => {
                    this.allRoles = data.roles;
                    this.userRoles = data.userRoles;
                });
        },
        loadRolePermissions(roleId) {
            fetch(`/api/role-permissions/${roleId}`)
                .then(response => response.json())
                .then(data => {
                    this.allPermissions = data.permissions;
                    this.rolePermissions = data.rolePermissions;
                });
        },
        loadUserPermissions(userId) {
            fetch(`/api/user-permissions/${userId}`)
                .then(response => response.json())
                .then(data => {
                    this.allPermissions = data.permissions;
                    this.userPermissions = data.userPermissions;
                });
        },
        toggleRole(roleName, assign) {
            fetch('/api/assign-role-to-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    user_id: this.selectedUserForRoles,
                    role: roleName,
                    assign: assign
                })
            })
            .then(response => response.json())
            .then(data => {
                // alert(data.message);
                showToast(text=data.message)
            })
            .catch(error => {
                alert('Error: ' + error.message);
                showToast(text=error.message, type='danger')

            });
        },
        togglePermissionToRole(permissionName, assign) {
            fetch('/api/assign-permission-to-role', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    role_id: this.selectedRoleForPermissions,
                    permission: permissionName,
                    assign: assign
                })
            })
            .then(response => response.json())
            .then(data => {
                // alert(data.message);
                showToast(text=data.message)
                
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        },
        togglePermissionToUser(permissionName, assign) {
            fetch('/api/assign-permission-to-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    user_id: this.selectedUserForPermissions,
                    permission: permissionName,
                    assign: assign
                })
            })
            .then(response => response.json())
            .then(data => {
                // alert(data.message);
                showToast(text=data.message)

            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        }
    },
    mounted() {
        // Initialize allRoles and allPermissions if needed
        this.allRoles = this.roles;
        this.allPermissions = this.permissions;
    }
}).mount('#app');
</script>
@endpush
