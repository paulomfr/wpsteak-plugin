/* eslint-disable import/prefer-default-export */
/**
 * Internal dependencies.
 */
import edit from "./edit";
import save from "./save";
import metadata from "./block.json";

const { name } = metadata;

export { metadata, name };

export const settings = {
  title: "Example",
  description: "Custom block example",
  icon: "smiley",
  keywords: ["example"],
  supports: {
    align: true
  },
  edit,
  save
};
