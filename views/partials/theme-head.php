<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "on-background": "#1a1c1c",
        "on-primary-container": "#fff9f8",
        "tertiary": "#005f93",
        "surface-dim": "#dadada",
        "primary-fixed": "#ffdad6",
        "surface-container-low": "#f3f3f3",
        "on-primary": "#ffffff",
        "surface-tint": "#c00015",
        "surface-container": "#eeeeee",
        "surface-container-highest": "#e2e2e2",
        "surface-container-lowest": "#ffffff",
        "surface-variant": "#e2e2e2",
        "primary": "#b90014",
        "primary-container": "#e31b23",
        "outline": "#926e6b",
        "error": "#ba1a1a",
        "background": "#f9f9f9",
        "outline-variant": "#e7bdb8",
        "secondary": "#5f5e5e",
        "on-surface": "#1a1c1c",
        "error-container": "#ffdad6",
        "on-error-container": "#93000a",
        "on-surface-variant": "#5d3f3c",
        "surface": "#f9f9f9",
        "inverse-surface": "#2f3131",
        "inverse-on-surface": "#f1f1f1"
      },
      borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.5rem", full: "0.75rem" },
      spacing: {
        "margin-desktop": "40px",
        "container-max-width": "1280px",
        "gutter": "24px",
        "margin-mobile": "16px"
      },
      fontFamily: {
        sans: ["Montserrat", "sans-serif"],
        "headline-xl": ["Montserrat"],
        "label-sm": ["Montserrat"],
        "label-md": ["Montserrat"],
        "headline-lg": ["Montserrat"],
        "headline-lg-mobile": ["Montserrat"],
        "headline-md": ["Montserrat"],
        "body-lg": ["Montserrat"],
        "body-md": ["Montserrat"]
      },
      fontSize: {
        "headline-xl": ["48px", { lineHeight: "56px", letterSpacing: "-0.02em", fontWeight: "800" }],
        "label-sm": ["12px", { lineHeight: "16px", fontWeight: "500" }],
        "label-md": ["14px", { lineHeight: "20px", fontWeight: "600" }],
        "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "700" }],
        "headline-lg-mobile": ["28px", { lineHeight: "34px", fontWeight: "700" }],
        "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
        "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }]
      }
    }
  }
}
</script>
<link href="<?= APP_URL ?>/public/assets/css/theme.css" rel="stylesheet">
