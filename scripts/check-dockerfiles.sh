#!/usr/bin/env bash
set -e

MISSING=0
FILES=(infra/worker.Dockerfile Dockerfile)

for f in "${FILES[@]}"; do
  if [ ! -f "$f" ]; then
    echo "Missing required file: $f"
    MISSING=1
  else
    echo "Found $f"
  fi
done

if [ $MISSING -eq 1 ]; then
  echo "One or more required files missing. Exiting."
  exit 2
fi

echo "All required dockerfiles present." 
