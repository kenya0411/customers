<template>
  <div id="teleport-component">
    <h3>Teleport元（コンポーネント）</h3>
    <div>↓↓↓↓Teleport元↓↓↓↓</div>
    <teleport to="#teleport-target"> <!--（1）-->
      このテキストがTeleportされます
    </teleport>
    <div>↑↑↑↑Teleport元↑↑↑↑</div>
  </div>
</template>