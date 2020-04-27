/* eslint-disable import/prefer-default-export */
/**
 * WordPress dependencies.
 */
import {
  registerBlockType,
  // eslint-disable-next-line camelcase
  unstable__bootstrapServerSideBlockDefinitions
} from "@wordpress/blocks";

/**
 * Internal dependencies.
 */
// import * as example from "./example";
import * as tabs from "./tabs";

/**
 * Function to register an individual block.
 *
 * @param {Object} block The block to be registered.
 *
 */
const registerBlock = block => {
  if (!block) {
    return;
  }

  const { metadata, settings, name } = block;

  if (metadata) {
    unstable__bootstrapServerSideBlockDefinitions({ [name]: metadata });
  }

  registerBlockType(name, settings);
};

/**
 * Function to register steak blocks provided by the block editor.
 */
export const registerSteakBlocks = () => {
  [tabs].forEach(registerBlock);
};
