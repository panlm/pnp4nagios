#!/bin/bash -x

HEAD="$(git symbolic-ref HEAD)" || exit 1

die()
{
        echo "git-svn-update: $*"
        exit 1
}

git svn fetch || die "failed to fetch SVN changes"
git branch -f svn/tmp master || die "failed to update/create temporary working branch"
git rebase --onto git-svn svn/master svn/tmp || die "failed to rebase on top of git svn branch"
git svn dcommit || die "failed to update SVN repository"
git branch -f svn/master master
git checkout "${HEAD#refs/heads/}"
git branch -D svn/tmp
