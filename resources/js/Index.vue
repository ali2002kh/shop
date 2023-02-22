<template>
    <router-view v-slot="{ Component, route }">
    <transition name="fade">
        <component :is="Component" :key="route.path" />
    </transition>
    </router-view>
</template>