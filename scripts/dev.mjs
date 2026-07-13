import { spawn } from "node:child_process";

const cwd = process.cwd();
const env = {
  ...process.env,
  APP_ENV: process.env.APP_ENV ?? "development",
  RUTA: process.env.RUTA ?? "http://localhost:5173",
  LANG_DEFAULT: process.env.LANG_DEFAULT ?? "es",
};

const processes = [
  {
    name: "vite",
    command: "vite",
    args: ["--host", "localhost", "--port", "5173"],
  },
  {
    name: "php",
    command: "php",
    args: ["-S", "localhost:3000", "-t", "public", "public/index.php"],
  },
];

const children = processes.map(({ name, command, args }) => {
  const child = spawn(command, args, {
    cwd,
    env,
    stdio: "inherit",
    shell: true,
  });

  child.on("error", (error) => {
    console.error(`[${name}] ${error.message}`);
  });

  return child;
});

console.log("PHP:  http://localhost:3000");
console.log("Vite: http://localhost:5173");

let closing = false;

const shutdown = (code = 0) => {
  if (closing) return;
  closing = true;

  for (const child of children) {
    if (!child.killed) {
      child.kill();
    }
  }

  process.exit(code);
};

for (const child of children) {
  child.on("exit", (code) => {
    if (!closing) {
      shutdown(code ?? 0);
    }
  });
}

process.on("SIGINT", () => shutdown(0));
process.on("SIGTERM", () => shutdown(0));
