<template>
  <v-dialog content-class="modal" dark>
    <v-img
      class="mx-1 loader"
      src="../../img/swapp_image_logo.svg"
      max-height="100"
      max-width="100"
      contain
      alt="logo"
    ></v-img>
    <v-skeleton-loader class="mx-auto" max-width="300" type="card"></v-skeleton-loader>
  </v-dialog>
</template>

<script>
export default {
    name: "Loader"
}
</script>

<style lang="scss">
.modal {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 200px;
  height: 150px;
}

.loader {
  -webkit-animation: rotation 1s infinite linear;
  position: absolute;
}
@-webkit-keyframes rotation {
  from {
    -webkit-transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(359deg);
  }
}
// .v-btn {
//   &:hover {
//   border-color: #967dff;
//   transform: translateY(-3px);
//   box-shadow: 0 1rem 2rem rgba(#000,.2);
//   }
//   &:hover &__content{
//     color: #967dff;
//   }
// }
</style>