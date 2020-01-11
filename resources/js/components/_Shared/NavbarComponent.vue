<template>
    <div>
        <b-navbar toggleable="md" type="dark" variant="dark">
            <b-navbar-brand href="#">Vision</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav v-if="auth">
                    <b-nav-item href="/task">{{ $t('partials.navigation.Tasks') }}</b-nav-item>
                    <b-nav-item href="/board">{{ $t('partials.navigation.Boards') }}</b-nav-item>
                </b-navbar-nav>
                <b-navbar-nav v-else>
                    <b-nav-item href="/login">{{ $t('partials.navigation.Login') }}</b-nav-item>
                    <b-nav-item href="/register">{{ $t('partials.navigation.Register') }}</b-nav-item>
                </b-navbar-nav>

                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-form class="d-none">
                        <b-form-input size="sm" class="mr-sm-2" placeholder="Search"></b-form-input>
                        <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
                    </b-nav-form>

                    <b-nav-item-dropdown class="d-none" text="Lang" right>
                        <b-dropdown-item href="#">EN</b-dropdown-item>
                        <b-dropdown-item href="#">ES</b-dropdown-item>
                        <b-dropdown-item href="#">RU</b-dropdown-item>
                        <b-dropdown-item href="#">FA</b-dropdown-item>
                    </b-nav-item-dropdown>

                    <b-nav-item-dropdown right v-if="user">
                        <!-- Using 'button-content' slot -->
                        <template v-slot:button-content>
                            <avatar-component :user="user"></avatar-component>
                            <em>{{ user.name }}</em>
                        </template>
                        <b-dropdown-item :href="user.url">{{ user.name }}</b-dropdown-item>
                        <b-dropdown-item href="logout">{{ $t('partials.navigation.Logout') }}</b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                auth: false,
                user: null,
            }
        },
        mounted() {
            this.auth = Application.auth;
            if(this.auth)
                this.user = Application.user;
        },
    }
</script>

<style scoped>

</style>
