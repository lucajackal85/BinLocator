GIT_VERSION_FULL=`curl -s https://api.github.com/repos/$TRAVIS_REPO_SLUG/tags | grep -m 1 -oP '"name": "\K(.*)(?=")'`
GIT_VERSION_MAJOR=`echo "$GIT_VERSION_FULL" | grep -oP "v([0-9]+)\.([0-9]+)"`
GIT_VERSION_MINOR=`echo "$GIT_VERSION_FULL" | grep -oP "([0-9]+)$"`

GIT_VERSION_NEXT_MINOR=`expr $GIT_VERSION_MINOR + 1`
GIT_TAG=$GIT_VERSION_MAJOR.$GIT_VERSION_NEXT_MINOR

echo "current => $GIT_VERSION_FULL"
echo "next => $GIT_TAG"

if [[ "$GIT_VERSION_FULL" != "" && "$GIT_VERSION_MAJOR" != "" && "$GIT_VERSION_MINOR" != "" ]]; then
####### GIT TAG ###########
echo "Creating TAG $GIT_TAG"
git config --global user.email "builds@travis-ci.com"
git config --global user.name "Travis CI"
git tag $GIT_TAG -a -m "Tag Generated from TravisCI for build $TRAVIS_BUILD_NUMBER"
git push https://${GH_TOKEN}@github.com/${TRAVIS_REPO_SLUG} --tags
fi