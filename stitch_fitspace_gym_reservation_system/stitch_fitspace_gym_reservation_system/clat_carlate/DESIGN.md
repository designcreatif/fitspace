---
name: Éclat Écarlate
colors:
  surface: '#f9f9f9'
  surface-dim: '#dadada'
  surface-bright: '#f9f9f9'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f3f3'
  surface-container: '#eeeeee'
  surface-container-high: '#e8e8e8'
  surface-container-highest: '#e2e2e2'
  on-surface: '#1a1c1c'
  on-surface-variant: '#5d3f3c'
  inverse-surface: '#2f3131'
  inverse-on-surface: '#f1f1f1'
  outline: '#926e6b'
  outline-variant: '#e7bdb8'
  surface-tint: '#c00015'
  primary: '#b90014'
  on-primary: '#ffffff'
  primary-container: '#e31b23'
  on-primary-container: '#fff9f8'
  inverse-primary: '#ffb4ac'
  secondary: '#5f5e5e'
  on-secondary: '#ffffff'
  secondary-container: '#e2dfde'
  on-secondary-container: '#636262'
  tertiary: '#005f93'
  on-tertiary: '#ffffff'
  tertiary-container: '#0079b9'
  on-tertiary-container: '#f9faff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdad6'
  primary-fixed-dim: '#ffb4ac'
  on-primary-fixed: '#410002'
  on-primary-fixed-variant: '#93000d'
  secondary-fixed: '#e5e2e1'
  secondary-fixed-dim: '#c8c6c5'
  on-secondary-fixed: '#1c1b1b'
  on-secondary-fixed-variant: '#474746'
  tertiary-fixed: '#cde5ff'
  tertiary-fixed-dim: '#94ccff'
  on-tertiary-fixed: '#001d32'
  on-tertiary-fixed-variant: '#004b74'
  background: '#f9f9f9'
  on-background: '#1a1c1c'
  surface-variant: '#e2e2e2'
typography:
  headline-xl:
    fontFamily: Montserrat
    fontSize: 48px
    fontWeight: '800'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Montserrat
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Montserrat
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 34px
  headline-md:
    fontFamily: Montserrat
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Montserrat
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Montserrat
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Montserrat
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
  label-sm:
    fontFamily: Montserrat
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 8px
  container-max-width: 1280px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 40px
---

## Marque et Style
Le système de design adopte une esthétique **Minimaliste Moderne** avec une influence **Haute-Couture**. L'objectif est d'évoquer la précision, l'énergie et le luxe contemporain. La transition vers un thème clair privilégie la clarté, l'espace négatif et une structure rigoureuse pour mettre en valeur le contenu de manière sophistiquée.

L'expérience utilisateur doit se sentir aérée mais intentionnelle, utilisant le rouge vif comme un signal directionnel fort contre un environnement immaculé. Le contraste élevé assure une lisibilité maximale et une présence institutionnelle solide.

## Couleurs
La palette est dominée par le **Rouge Primaire (#e31b23)**, utilisé exclusivement pour les actions principales, les états actifs et les messages critiques. 

- **Surface Principale :** Blanc pur (#ffffff) pour une clarté absolue.
- **Surfaces Secondaires :** Gris très clair (#f5f5f5) pour délimiter les zones de contenu sans alourdir l'interface.
- **Typographie :** Noir absolu pour les titres afin d'ancrer la hiérarchie visuelle, et un gris profond (#4a4a4a) pour le texte de labeur afin de réduire la fatigue oculaire tout en maintenant un contraste élevé.

## Typographie
Le système utilise exclusivement **Montserrat** pour affirmer une identité géométrique et moderne. 

Les titres (Headlines) utilisent des graisses lourdes (Bold/ExtraBold) et un espacement de caractères serré pour un impact maximal. Le texte courant (Body) privilégie la clarté avec un interlignage généreux. Les libellés (Labels) sont souvent présentés en majuscules avec une graisse semi-bold pour une distinction rapide dans les formulaires et les micro-copies.

## Mise en page et Espacement
Le système repose sur une **grille fluide de 12 colonnes** sur ordinateur, se réduisant à 4 colonnes sur mobile. 

L'espacement suit une progression arithmétique basée sur une unité de 8px. Une attention particulière est portée aux marges externes ("safe areas") pour éviter tout encombrement visuel. Les éléments de contenu sont séparés par des gouttières de 24px, garantissant une respiration constante entre les composants.

## Élévation et Profondeur
Le design privilégie des **calques tonaux** plutôt que des ombres portées traditionnelles. La profondeur est créée par :

1.  **Changement de fond :** Utilisation du gris clair (#f5f5f5) pour les conteneurs en arrière-plan.
2.  **Bordures de faible contraste :** Les éléments au même niveau sont séparés par des bordures fines (1px) de couleur gris perle (#e0e0e0).
3.  **Survol (Hover) :** Une ombre portée très diffuse et légère (opacité 5%, flou 15px) est autorisée uniquement pour indiquer l'interactivité sur les cartes et les boutons d'action principaux.

## Formes
Le système adopte une approche **Soft (Douce)**. Les angles sont légèrement arrondis pour adoucir la rigueur de la typographie géométrique.

- Les boutons et les champs de saisie utilisent un rayon de 4px (0.25rem).
- Les conteneurs plus larges (cartes, modales) utilisent un rayon de 8px (0.5rem).
- Les éléments de type "Badge" ou "Chip" peuvent exceptionnellement être arrondis à 12px pour se différencier des boutons d'action.

## Composants

- **Boutons :** Le bouton primaire est plein, utilisant le rouge (#e31b23) avec texte blanc. Le bouton secondaire est une bordure noire (outline) avec texte noir.
- **Champs de saisie (Inputs) :** Fond blanc, bordure grise de 1px. Lors du focus, la bordure devient noire et s'épaissit à 2px pour un retour visuel clair.
- **Cartes (Cards) :** Fond blanc avec une bordure fine grise. Aucun effet d'ombre au repos pour maintenir l'aspect minimaliste.
- **Listes :** Séparateurs horizontaux de 1px gris clair. Les éléments sélectionnés utilisent un indicateur vertical rouge à gauche de l'élément.
- **Cases à cocher et Radio :** Utilisation du rouge pour l'état sélectionné afin de garantir que l'action de l'utilisateur soit immédiatement repérable.
- **Barre de navigation :** Fond blanc pur avec une ligne de séparation subtile en bas. Les liens actifs sont soulignés par une ligne rouge de 2px.