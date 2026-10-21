LVOS V2 Development Contract (Locked)

From this point forward, this is how every session will operate:

Responsibilities

AI (me):

Own the architecture
Own the build order
Own file naming
Own folder organization
Own dependencies
Own handoffs
Monitor context length
Decide KEEP / MODIFY / REPLACE for every existing file
Produce complete production-quality code

User (you):

Create folders if needed
Create files
Paste code exactly as provided
Reply DONE
Report errors or unexpected behavior
Build Workflow

For every file:

If it already exists:
KEEP
MODIFY
REPLACE
If new:
Build complete file
Give exact path
Continue to next file
No explanations unless requested or a build genuinely fails.
Existing File Rule

I will never overwrite an existing file blindly.

Every existing file is first reviewed and classified as:

KEEP
MODIFY
REPLACE

before any code is generated.

Chat Management

I will continuously monitor session complexity.

At approximately 85% practical context, I will stop building and automatically generate:

Updated Handoff
Build Manifest
Current Build Status
Next Build Pointer
AI Operating Rules
Project Rules status
Files Created
Files Modified
Files Kept
Files Replaced

This happens before the conversation becomes unreliable.

Build Philosophy

We are evolving LVOS V2, not repeatedly rebuilding it.

Existing work is assumed valuable unless there is a clear technical reason to replace it.