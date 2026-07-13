const initNav01 = () => {
  const navs = document.querySelectorAll("[data-nav01]");

  navs.forEach((nav) => {
    const toggle = nav.querySelector("[data-nav01-toggle]");
    const panel = nav.querySelector("[data-nav01-menu]");
    const submenuItems = nav.querySelectorAll("[data-nav01-submenu-item]");

    if (!toggle || !panel) {
      return;
    }

    const setSubmenuOpen = (item, isOpen) => {
      const submenuToggle = item.querySelector("[data-nav01-submenu-toggle]");
      const label = submenuToggle?.dataset.nav01SubmenuLabel ?? "";
      const openLabel = submenuToggle?.dataset.nav01LabelOpen ?? "Abrir submenu";
      const closeLabel = submenuToggle?.dataset.nav01LabelClose ?? "Cerrar submenu";

      item.classList.toggle("is-submenu-open", isOpen);
      submenuToggle?.setAttribute("aria-expanded", String(isOpen));
      submenuToggle?.setAttribute("aria-label", `${isOpen ? closeLabel : openLabel} ${label}`.trim());
    };

    const closeSubmenus = (except = null) => {
      submenuItems.forEach((item) => {
        if (item !== except) {
          setSubmenuOpen(item, false);
        }
      });
    };

    const setOpen = (isOpen) => {
      const openLabel = toggle.dataset.nav01LabelOpen ?? "Abrir menu";
      const closeLabel = toggle.dataset.nav01LabelClose ?? "Cerrar menu";

      nav.classList.toggle("is-open", isOpen);
      toggle.setAttribute("aria-expanded", String(isOpen));
      toggle.setAttribute("aria-label", isOpen ? closeLabel : openLabel);

      if (!isOpen) {
        closeSubmenus();
      }
    };

    toggle.addEventListener("click", () => {
      setOpen(!nav.classList.contains("is-open"));
    });

    submenuItems.forEach((item) => {
      const submenuToggle = item.querySelector("[data-nav01-submenu-toggle]");

      submenuToggle?.addEventListener("click", (event) => {
        event.preventDefault();
        event.stopPropagation();

        const isOpen = !item.classList.contains("is-submenu-open");
        closeSubmenus(item);
        setSubmenuOpen(item, isOpen);
      });
    });

    nav.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => {
        setOpen(false);
        closeSubmenus();
      });
    });

    document.addEventListener("click", (event) => {
      if (nav.classList.contains("is-open") && !nav.contains(event.target)) {
        setOpen(false);
      }

      if (!nav.contains(event.target)) {
        closeSubmenus();
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        setOpen(false);
        closeSubmenus();
      }
    });

    // Debe coincidir con $desktop de _config.scss.
    window.matchMedia("(min-width: 1200px)").addEventListener("change", (event) => {
      if (event.matches) {
        setOpen(false);
        closeSubmenus();
      }
    });
  });
};

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initNav01);
} else {
  initNav01();
}
