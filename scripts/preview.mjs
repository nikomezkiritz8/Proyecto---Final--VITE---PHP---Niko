import { spawn } from "node:child_process";
import { existsSync } from "node:fs";
import { join } from "node:path";

const cwd = process.cwd();
const router = join(cwd, "dist", "index.php");

if (!existsSync(router)) {
  console.error("No existe dist/index.php. Ejecuta npm run build antes del preview.");
  process.exit(1);
}

const env = {
  ...process.env,
  APP_ENV: "preview",
  RUTA: process.env.RUTA ?? "http://localhost:4173",
  LANG_DEFAULT: process.env.LANG_DEFAULT ?? "es",
};

console.log("Preview PHP: http://localhost:4173");

const child = spawn("php", ["-S", "localhost:4173", "-t", "dist", "dist/index.php"], {
  cwd,
  env,
  stdio: "inherit",
  shell: true,
});

child.on("exit", (code) => process.exit(code ?? 0));
process.on("SIGINT", () => child.kill());
process.on("SIGTERM", () => child.kill());
