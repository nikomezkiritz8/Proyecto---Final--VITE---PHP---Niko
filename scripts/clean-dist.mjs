import { rmSync } from "node:fs";
import { resolve } from "node:path";

const root = process.cwd();
const dist = resolve(root, "dist");

if (!dist.startsWith(root)) {
  throw new Error(`Ruta dist fuera del proyecto: ${dist}`);
}

rmSync(dist, {
  recursive: true,
  force: true,
});
