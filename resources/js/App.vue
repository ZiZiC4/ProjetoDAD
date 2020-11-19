<template>
    <div>

        <header>

            <div id="menuIcon">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </header>

        <div class="container">
            <nav>
                <ul>

                    <li>
                        <i class="fas fa-info-circle"></i>
                        <a>Home Page</a>
                    </li>
                    <li>
                        <i class="fas fa-box"></i>
                        <a>Users</a>
                    </li>
                    <li>
                        <i class="far fa-file"></i>
                        <a>Contas</a>
                    </li>
                    <li>
                        <i class="fab fa-wpforms"></i>
                        <a>Perfil</a>
                    </li>
                    <li>
                        <i class="fab fa-wpforms"></i>
                        <a>Estatisticas</a>
                    </li>
                </ul>
            </nav>
            <section id="main">
                <div class="left-content">
                    <router-view></router-view>
                </div>
                <footer>
                    <p>
                        © <a>Food@Home</a>
                    </p>
                </footer>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>