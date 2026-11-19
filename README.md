<div align="center">
  <h1>Fitzeno Club Website</h1>
  <p><strong>Fitness clubs, classes and coaching in an editorial web experience.</strong></p>
  <p><img alt="PHP 8.2" src="https://img.shields.io/badge/PHP%208.2-243447?style=flat-square"> <img alt="MySQL" src="https://img.shields.io/badge/MySQL-243447?style=flat-square"> <img alt="Fitness CMS" src="https://img.shields.io/badge/Fitness%20CMS-243447?style=flat-square"> <img alt="GSAP" src="https://img.shields.io/badge/GSAP-243447?style=flat-square"></p>
</div>

---

## Overview

A fitness club demo website with location and class pages, coaching, a journal, product presentation and enquiry capture. Its private control room lets staff update content and follow leads.

> [!NOTE]
> This is a public source snapshot prepared from a local project. It includes implementation code and safe schema/sample data, without live records or credentials.

## What the software can do

| Area | Implemented scope |
| --- | --- |
| **Club discovery** | Location profiles, class catalogue and class detail routes. |
| **Coaching and journal** | Editorial coaching pages and publishable articles. |
| **Shop presentation** | Product catalogue/detail and product enquiry path. |
| **Admin control room** | Site settings, classes, articles, products and lead follow-up. |
| **SEO** | Readable routes, canonical/Open Graph tags, sitemap and robots rules. |

### Typical workflow

1. A local first visit creates tables and fictional starter content.
2. A staff member creates the first admin account through the installer.
3. Visitors discover clubs/classes or products and send enquiries for staff review.

## Run locally

1. Use PHP 8.2, PDO MySQL and Apache rewrite support.
2. Create an empty MySQL database and set new local values in `config.php`.
3. Open the local website to initialize the schema and fictional content.
4. Visit `install.php` to create a private admin account, then sign in at `/control-room`.

## Database and sample content

`app/schema.php` creates admins, settings, articles, products, classes, clubs and leads tables, then inserts fictional content when empty. No live database export or leads are included.

## Repository guide

| Path | Purpose |
| --- | --- |
| `index.php` | Public route dispatch |
| `app/schema.php` | Schema and sample content |
| `app/admin.php` | Control room actions |
| `app/views/` | Public page templates |
| `assets/` | Styles and browser interactions |

## Security and privacy

- Admin and enquiry forms use CSRF tokens; passwords are hashed.
- Public routes do not link to the control room.

## Current boundaries

- The shop is a catalogue with enquiries, not a card checkout or shipping engine.
- Club details, availability, photos and pricing are sample content.

## Verification

Exercise first-run setup, control-room content edits and enquiry submission on a new local database.

---

<div align="center">

Software Development by <a href="https://www.energeticedge.lk/" target="_blank" rel="noopener noreferrer">Energetic Edge (Pvt) Ltd</a>

</div>
